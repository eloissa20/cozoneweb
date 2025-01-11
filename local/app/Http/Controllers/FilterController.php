<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\DeskField;
use App\Models\Favorite;
//use App\Models\MeetingField;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    public function client_home(Request $request)
    {
        $query = Cowork::query();

        if ($request->has('search')) {
            $query->where('coworking_space_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('coworking_space_address', 'LIKE', '%' . $request->search . '%');
        }

        $spaces = $query->paginate(6);

        $user = auth()->user();
        $favoriteSpaceIds = [];

        if ($user) {
            $favoriteSpaceIds = Favorite::where('user_id', $user->id)->pluck('space_id')->toArray();
        }

        foreach ($spaces as $space) {
            $space->isFavorite = in_array($space->id, $favoriteSpaceIds);
        }

        return view('client_side.home_client', ['spaces' => $spaces]);
    }

    public function client_list(Request $request)
    {
        $query = Cowork::query();

        if ($request->has('search')) {
            $query->where('coworking_space_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('coworking_space_address', 'LIKE', '%' . $request->search . '%');
        }

        $spaces = $query->get();

        $user = auth()->user();
        $favoriteSpaceIds = [];

        if ($user) {
            $favoriteSpaceIds = Favorite::where('user_id', $user->id)->pluck('space_id')->toArray();
        }

        foreach ($spaces as $space) {
            $space->isFavorite = in_array($space->id, $favoriteSpaceIds);

            // Retrieve desk field data for pricing
            $deskField = DeskField::where('space_id', $space->id)->get();
            //$meetingField = MeetingField::where('space_id', $space->id)->get(); // Uncomment this when using MeetingField

            // Merge desk field and meeting field data if required
            //$pricing = $deskField->merge($meetingField); // Uncomment to merge meeting fields
            $pricing = $deskField; // Assuming you are working with DeskField only

            // Attach pricing to the space
            $space->pricing = $pricing;

            // Calculate the lowest price if pricing exists and is not empty
            $space->lowestPrice = $pricing->isEmpty() ? null : $pricing->min('price');
        }

        // dd($spaces); // Uncomment to debug spaces
        return view('client_side.lists_client', ['spaces' => $spaces]);
    }
}
