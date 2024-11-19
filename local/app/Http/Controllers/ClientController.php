<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Favorites;
use App\Models\Reviews;
use App\Models\Transactions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    //profile
    public function profile_update(Request $request, User $user)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:15',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($validated); //this return true but not updating the database

        return redirect()->route('client_side.profile')->with('message', 'User updated successfully!');
    }

    //favorite
    public function remove_favorite(Request $request)
    {
        $favorite = Favorites::find($request->id);
        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Cowork remove to favorite.']);
        }
        return response()->json(['success' => false, 'message' => 'Cowork remove failed.']);
    }

    public function remove_favorite_by_space(Request $request)
    {
        $favorite = Favorites::where('space_id', $request->id);
        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Cowork remove to favorite.']);
        }
        return response()->json(['success' => false, 'message' => 'Cowork remove failed.']);
    }

    public function add_to_favorite(Request $request)
    {
        $exists = Favorites::where('user_id', auth()->user()->id)
            ->where('space_id', $request->id)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This cowork is already in your favorites.']);
        }

        $favorite = Favorites::create([
            'user_id' => auth()->user()->id,
            'space_id' => $request->id,
        ]);

        if ($favorite) {
            return response()->json(['success' => true, 'message' => 'Cowork added to favorites.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to add cowork to favorites.']);
    }


    //cowork details
    public function show_cowork_details(Request $request)
    {
        $space = Cowork::find($request->id);

        if (!$space) {
            return abort(404, 'Space not found');
        }
        $jsonWithObject = [
            'basics',
            'seats',
            'equipment',
            'facilities',
            'accessibility',
            'perks',
        ];

        foreach ($jsonWithObject as $field) {
            if (is_string($space->$field)) {
                $decodedValue = stripslashes(trim($space->$field, '"'));

                $space->$field = json_decode($decodedValue, true) ?: [];
            }
        }

        $jsonWithObject = [
            'desk_fields',
            'meeting_fields'
        ];

        foreach ($jsonWithObject as $field) {
            if (is_string($space->$field) && !empty(trim($space->$field))) {
                $decodedArray = json_decode($space->$field, true);

                if (is_array($decodedArray)) {
                    foreach ($decodedArray as $key => $value) {
                        if (is_string($value)) {
                            $decodedArray[$key] = json_decode(trim($value, '"'), true) ?: [];
                        }
                    }
                    $space->$field = $decodedArray;
                } else {
                    $space->$field = [];
                }
            } else {
                $space->$field = [];
            }
        }

        $allReviews = Reviews::where('cowork_id', $space->id)->get();
        $averageRating = Reviews::where('cowork_id', $space->id)
        ->avg('rating');

        return view('client_side.details_client', ['space' => $space, 'allReviews' => $allReviews, 'averageRating' => $averageRating]);
    }




    //transactions
    public function transaction_table(Request $request)
    {
        if ($request->ajax()) {
            $request = auth()->user()->user_transactions()->with('cowork')->get();

            return DataTables::of($request)
                ->addColumn('space_name', function ($row) {
                    return $row->cowork ? $row->cowork->coworking_space_name : 'N/A';
                })
                ->addColumn('location', function ($row) {
                    return $row->cowork ? $row->cowork->coworking_space_address : 'N/A';
                })
                ->editColumn('date', function ($row) {
                    return Carbon::parse($row->date)->format('D F j, Y');
                    ;
                })
                ->make(true);
        }
    }
}