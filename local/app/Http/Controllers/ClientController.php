<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\DeskField;
use App\Models\Favorite;
use App\Models\MeetingField;
use App\Models\Reply;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    //profile
    public function profile_update(Request $request, User $user)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'contact' => 'nullable|string|max:15',
                'birthday' => 'nullable|date',
                'gender' => 'nullable|string|max:10',
                'address' => 'nullable|string|max:255',
            ]);

            $user->update($validated);

            return redirect()->route('client_side.profile')->with('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    //favorites
    public function remove_favorite(Request $request)
    {
        $favorite = Favorite::find($request->id);
        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Cowork remove to favorite.']);
        }
        return response()->json(['success' => false, 'message' => 'Cowork remove failed.']);
    }

    public function remove_favorite_by_space(Request $request)
    {
        $favorite = Favorite::where('space_id', $request->id);
        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Cowork remove to favorite.']);
        }
        return response()->json(['success' => false, 'message' => 'Cowork remove failed.']);
    }

    public function add_to_favorite(Request $request)
    {
        $exists = Favorite::where('user_id', auth()->user()->id)
            ->where('space_id', $request->id)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This cowork is already in your favorites.']);
        }

        $favorite = Favorite::create([
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
        try {
            $space = Cowork::find($request->id);

            if (!$space) {
                return redirect()->back()->with('error', 'No space found!');
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

            $deskField = DeskField::where('space_id', $space->id)->get();
            $meetingField = MeetingField::where('space_id', $space->id)->get();

            $pricing = [
                ...$deskField,
                ...$meetingField
            ];


            // $jsonWithObject = [
            //     'desk_fields',
            //     'meeting_fields',
            // ];

            // foreach ($jsonWithObject as $field) {
            //     if (is_string($space->$field) && !empty(trim($space->$field))) {
            //         $decodedArray = json_decode($space->$field, true);

            //         if (is_array($decodedArray)) {
            //             foreach ($decodedArray as $key => $value) {
            //                 if (is_string($value)) {
            //                     $decodedArray[$key] = json_decode(trim($value, '"'), true) ?: [];
            //                 }
            //             }
            //             $space->$field = $decodedArray;
            //         } else {
            //             $space->$field = [];
            //         }
            //     } else {
            //         $space->$field = [];
            //     }
            // }

            $images = [
                $space->header_image
            ];

            if ($space->additional_images) {
                $images = [
                    $space->header_image,
                    ...json_decode($space->additional_images, true)
                ];
            }

            $allReviews = Review::where('cowork_id', $space->id)->get();
            $allReplies = Reply::where('cowork_id', $space->id)->get();

            return view('client_side.details_client', ['space' => $space, 'pricing' => $pricing, 'allReviews' => $allReviews, 'allReplies' => $allReplies, 'images' => $images]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    //transactions
    public function transaction_table(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request = auth()->user()->user_transactions()->with('cowork')->get();

                return DataTables::of($request)
                    ->addColumn('invoice', function ($row) {
                        return $row->cowork ? '#00000' . $row->id : 'N/A';
                    })
                    ->addColumn('space_name', function ($row) {
                        return $row->cowork ? $row->cowork->coworking_space_name : 'N/A';
                    })
                    ->addColumn('location', function ($row) {
                        return $row->cowork ? $row->cowork->coworking_space_address : 'N/A';
                    })
                    ->editColumn('date', function ($row) {
                        return Carbon::parse($row->date)->format('D, F j, Y');
                        ;
                    })
                    ->editColumn('payment_method', function ($row) {
                        return ucfirst($row->payment_method);
                        ;
                    })
                    ->make(true);
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e);
            }

        } else {
            return redirect()->back()->with('error', 'Error loading transactions!');
        }
    }

    // contact

    public function send_email(Request $request)
    {
        try {
            $data = [
                "client" => $request->input('fullname'),
                "email" => $request->input('email'),
                "subject" => "New Message for Cozone",
                "message" => $request->input('message'),
            ];

            $mailController = new MailController();
            $mailController->sendMailToCozone($data);

            return redirect()->back()->with('success', 'Message sent! Please wait for the response of the cozone.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }
}