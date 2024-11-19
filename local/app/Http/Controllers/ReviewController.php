<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $spaceId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_body' => 'required|string|max:255',
        ]);

        $review = new Reviews();
        $review->user_id = auth()->id();
        $review->cowork_id = $spaceId;
        $review->rating = $validated['rating'];
        $review->review_body = $validated['review_body'];
        $review->save();

        return response()->json(['message' => 'Review added successfully!']);
    }
    public function update(Request $request, $id)
    {
        $review = Reviews::findOrFail($id);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_body' => 'required|string|max:255',
        ]);

        $review->rating = $validated['rating'];
        $review->review_body = $validated['review_body'];
        $review->save();

        return response()->json(['message' => 'Review updated successfully!']);
    }

    public function destroy($id)
    {
        $review = Reviews::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully!']);
    }

}