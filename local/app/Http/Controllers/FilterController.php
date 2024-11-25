<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Favorite;
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

        $spaces = $query->paginate(6);

        $user = auth()->user();
        $favoriteSpaceIds = [];

        if ($user) {
            $favoriteSpaceIds = Favorite::where('user_id', $user->id)->pluck('space_id')->toArray();
        }

        foreach ($spaces as $space) {
            $space->isFavorite = in_array($space->id, $favoriteSpaceIds);
        }
        return view('client_side.lists_client', ['spaces' => $spaces]);
    }
}