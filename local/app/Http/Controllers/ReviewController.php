<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $spaceId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_body' => 'required|string|max:255',
        ]);

        try {
            $review = new Review();
            $review->user_id = auth()->id();
            $review->cowork_id = $spaceId;
            $review->rating = $validated['rating'];
            $review->review_body = $validated['review_body'];
            $review->save();

            $this->updateAverageRating($spaceId);

            return response()->json([
                'success' => true,
                'message' => 'Review added successfully!',
                'review' => $review,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add review.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $review)
    {
        // Find the review by ID
        $review = Review::findOrFail($review);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_body' => 'required|string|max:255',
        ]);

        try {
            $review->rating = $validated['rating'];
            $review->review_body = $validated['review_body'];
            $review->save();

            $this->updateAverageRating($review->cowork_id);

            return response()->json([
                'success' => true,
                'message' => 'Review updated successfully!',
                'review' => $review,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update review.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->delete();

            $this->updateAverageRating($review->cowork_id);

            return response()->json([
                'success' => true,
                'message' => 'Review deleted successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete review.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function updateAverageRating($coworkId)
    {
        // Calculate the new average rating
        $averageRating = Review::where('cowork_id', $coworkId)->avg('rating');

        // Update the cowork space's average rating
        $coworkSpace = Cowork::findOrFail($coworkId);
        $coworkSpace->averageRating = $averageRating;
        $coworkSpace->save();
    }


}
