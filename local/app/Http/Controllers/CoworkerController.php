<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class CoworkerController extends Controller
{
    // public function viewDashboard()
    // {
    //     return view('coworker_side.coworker');
    // }

    public function viewDashboard()
    {
        // Fetch users from the database
        $users = DB::table('users')->select('id', 'name', 'email', 'created_at')->get();

        // Total users and percentage change calculation
        $totalUsers = $users->count();
        $lastMonth = Carbon::now()->subMonth();
        $usersLastMonth = DB::table('users')
            ->whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->count();

        $monthBeforeLast = Carbon::now()->subMonths(2);
        $usersMonthBeforeLast = DB::table('users')
            ->whereYear('created_at', $monthBeforeLast->year)
            ->whereMonth('created_at', $monthBeforeLast->month)
            ->count();

        $percentageChange = $usersMonthBeforeLast > 0 
            ? (($usersLastMonth - $usersMonthBeforeLast) / $usersMonthBeforeLast) * 100 
            : ($usersLastMonth > 0 ? 100 : 0);

        $percentageChange = round($percentageChange, 1);

        $data = [
            'total_users' => $totalUsers,
            'percentage_change' => $percentageChange,
            'users' => $users,
        ];

        return view('coworker_side.coworker', ['data' => $data]);
    }

    public function viewListSpace()
    {
        return view('coworker_side.listSpace');
    }

    public function viewmyCoworkingSpace(Request $request)
    {
        if ($request->ajax()) {
            $requests = DB::table('list_space_tbl')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                // ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $str = "<button class='btn btn-outline-dark btn-sm me-2'><i class='bi bi-pencil-square'></i> Update</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='deleteSpace(\"{$row->id}\")'><i class='bi bi-trash'></i> Delete</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='viewSpaceDetails(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>";
                    return $str;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('coworker_side.myCoworkingSpace');
    }

    public function viewSpaceDetails($id)
    {
        $spaceDetails = DB::table('list_space_tbl')->where('id', $id)->first();
    
        if (!$spaceDetails) {
            return response()->json(['error' => 'Space not found.'], 404);
        }
    
        $spaceDetails->header_image = asset($spaceDetails->header_image);
    
        return response()->json($spaceDetails);
    }

    public function deleteSpace($id)
    {
        $space = DB::table('list_space_tbl')->where('id', $id)->first();

        if (!$space) {
            return response()->json(['error' => 'Space not found.'], 404);
        }

        DB::table('list_space_tbl')->where('id', $id)->delete();

        return response()->json(['message' => 'Space deleted successfully.']);
    }

    



    public function submitListSpace(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'headerImage' => 'nullable|mimes:png,jpg,jpeg,webp',
            'additionalImages.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'headerImage.mimes' => 'The header image must be a file of type: png, jpg, jpeg, webp.',
            'additionalImages.*.mimes' => 'Each additional image must be a file of type: png, jpg, jpeg, webp.',
            'additionalImages.*.max' => 'Each additional image may not be larger than 2MB.',
        ]);


        if ($request->hasFile('headerImage')) {
            $file = $request->file('headerImage');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/header/';
            $file->move($path, $filename);
        } else {
            $filename = null;
        }

        $additionalImages = [];
        if ($request->hasFile('additionalImages')) {
            foreach ($request->file('additionalImages') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move('uploads/additional_images/', $imageName);
                $additionalImages[] = 'uploads/additional_images/' . $imageName;
            }
        }

        $data = [
            'role' => $request->input('role'),
            'coworking_space_name' => $request->input('coworkingSpaceName'),
            'coworking_space_address' => $request->input('coworkingSpaceAddress'),
            'space_name' => $request->input('spaceName'),
            'type_of_space' => $request->input('typeOfSpace'),
            'description' => $request->input('description'),
            'opening_date' => $request->input('openingDate'),
            'available_days_from' => $request->input('availableDaysFrom'),
            'available_days_to' => $request->input('availableDaysTo'),
            'exceptions'=> $request->input('exceptions'),
            'operating_hours_from' => $request->input('operatingHoursFrom'),
            'operating_hours_to' => $request->input('operatingHoursTo'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'instagram' => $request->input('instagram'),
            'facebook' => $request->input('facebook'),
            'contact_no' => $request->input('contactNo'),
            'basics' => json_encode($request->input('basics')),
            'seats' => json_encode($request->input('seats')),
            'equipment' => json_encode($request->input('equipment')),
            'facilities' => json_encode($request->input('facilities')),
            'accessibility' => json_encode($request->input('accessibility')),
            'perks' => json_encode($request->input('perks')),
            'location' => $request->input('location'),
            'telephone' => $request->input('telephone'),
            'country' => $request->input('country'),
            'unit' => $request->input('unit'),
            'postal' => $request->input('postal'),
            'city' => $request->input('city'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'tables' => $request->input('tables'),
            'capacity' => $request->input('capacity'),
            'meeting_rooms' => $request->input('meetingRoomsCount'),
            'virtual_offices' => $request->input('virtualOffices'),
            'size' => $request->input('size'),
            'measurement_unit' => $request->input('measurementUnit'),
            'header_image' => $path . $filename,
            'additional_images' => json_encode($additionalImages),
            'pay_online' => $request->input('payOnline'),
            'credit_cards' => $request->input('creditCards'),
            'eWallet' => $request->input('eWallet'),
            'desk_fields' => json_encode($request->input('desks')),
            'meeting_fields' => json_encode($request->input('meetingRooms')),
            'virtual_service' => $request->input('virtualService'),
            'membership' => $request->input('membership'),
            'membership_duration' => $request->input('membershipDuration'),
            'membership_price' => $request->input('membershipPrice'),
            'short_term' => $request->input('shortTerm'),
            'short_term_details' => $request->input('shortTermDetails'),
            'free_pass' => $request->input('freePass'),
            'free_pass_details' => $request->input('freePassDetails'),
        ];

        DB::table('list_space_tbl')->insert($data);

        return response()->json(['message' => 'Data inserted successfully.']);
    }

    public function viewReviews()
    {
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('list_space_tbl', 'reviews.cowork_id', '=', 'list_space_tbl.id')
            ->select('reviews.*', 'users.name as reviewer_name', 'list_space_tbl.space_name', 'list_space_tbl.header_image')
            ->get();

        if ($reviews->isEmpty()) {
            return view('coworker_side.reviews', [
                'reviews' => [],
                'totalReviews' => 0,
                'fiveStar' => 0,
                'fourStar' => 0,
                'threeStar' => 0,
                'twoStar' => 0,
                'oneStar' => 0,
                'averageRating' => 0,
            ]);
        }

        $reviews->transform(function ($review) {
            $review->created_at = Carbon::parse($review->created_at);
            return $review;
        });

        $totalReviews = $reviews->count();
        $fiveStar = $reviews->where('rating', 5)->count();
        $fourStar = $reviews->where('rating', 4)->count();
        $threeStar = $reviews->where('rating', 3)->count();
        $twoStar = $reviews->where('rating', 2)->count();
        $oneStar = $reviews->where('rating', 1)->count();

        $averageRating = $totalReviews > 0 ? $reviews->sum('rating') / $totalReviews : 0;

        return view('coworker_side.reviews', compact('reviews', 'totalReviews', 'fiveStar', 'fourStar', 'threeStar', 'twoStar', 'oneStar', 'averageRating'));
    }

    

    public function viewReservations()
    {
        return view('coworker_side.reservations');
    }


}