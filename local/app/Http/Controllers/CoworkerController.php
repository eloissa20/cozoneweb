<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class CoworkerController extends Controller
{
    // public function viewDashboard()
    // {
    //     return view('coworker_side.coworker');
    // }

    // public function viewDashboard()
    // {
    //     $users = DB::table('users')->select('id', 'name', 'email', 'created_at')->get();

    //     $totalUsers = $users->count();
    //     $lastMonth = Carbon::now()->subMonth();
    //     $usersLastMonth = DB::table('users')
    //         ->whereYear('created_at', $lastMonth->year)
    //         ->whereMonth('created_at', $lastMonth->month)
    //         ->count();

    //     $monthBeforeLast = Carbon::now()->subMonths(2);
    //     $usersMonthBeforeLast = DB::table('users')
    //         ->whereYear('created_at', $monthBeforeLast->year)
    //         ->whereMonth('created_at', $monthBeforeLast->month)
    //         ->count();

    //     $percentageChange = $usersMonthBeforeLast > 0
    //         ? (($usersLastMonth - $usersMonthBeforeLast) / $usersMonthBeforeLast) * 100
    //         : ($usersLastMonth > 0 ? 100 : 0);

    //     $percentageChange = round($percentageChange, 1);

    //     $data = [
    //         'total_users' => $totalUsers,
    //         'percentage_change' => $percentageChange,
    //         'users' => $users,
    //     ];

    //     return view('coworker_side.coworker');
    // }

    public function viewDashboard()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $lastWeekStart = $today->copy()->subWeek()->startOfDay();
        $lastWeekEnd = $today->copy()->subWeek()->endOfDay();

        $currentUserId = auth()->id();

        $userSpaces = DB::table('list_space_tbl')
            ->where('user_id', $currentUserId)
            ->pluck('id');

        $todaysMoney = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todaysClients = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereDate('created_at', $today)
            ->distinct('user_id')
            ->count('user_id');

        $todaysNewClients = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereBetween('created_at', [$today->copy()->startOfWeek(), $today])
            ->distinct('user_id')
            ->count('user_id');

        // Total sales (sum of all amounts)
        $totalSales = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->sum('amount');

        // Calculate last week's totals
        $lastWeekSales = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('amount');

        $lastWeekClients = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->distinct('user_id')
            ->count('user_id');

        $lastWeekNewClients = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->distinct('user_id')
            ->count('user_id');

        // Calculate yesterday's totals
        $yesterdaysMoney = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereDate('created_at', $yesterday)
            ->sum('amount');

        $yesterdaysClients = DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->whereDate('created_at', $yesterday)
            ->distinct('user_id')
            ->count('user_id');

        // Calculate percentages
        $moneyChangeYesterday = $yesterdaysMoney > 0
            ? (($todaysMoney - $yesterdaysMoney) / $yesterdaysMoney) * 100
            : 0;

        $salesChangeLastWeek = $lastWeekSales > 0
            ? (($totalSales - $lastWeekSales) / $lastWeekSales) * 100
            : 0;

        $clientsChangeYesterday = $yesterdaysClients > 0
            ? (($todaysClients - $yesterdaysClients) / $yesterdaysClients) * 100
            : 0;

        $newClientsChangeLastWeek = $lastWeekNewClients > 0
            ? (($todaysNewClients - $lastWeekNewClients) / $lastWeekNewClients) * 100
            : 0;

        // Pass data to view
        return view('coworker_side.coworker', [
            'todaysMoney' => $todaysMoney,
            'todaysClients' => $todaysClients,
            'todaysNewClients' => $todaysNewClients,
            'totalSales' => $totalSales,
            'moneyChangeYesterday' => $moneyChangeYesterday,
            'salesChangeLastWeek' => $salesChangeLastWeek,
            'clientsChangeYesterday' => $clientsChangeYesterday,
            'newClientsChangeLastWeek' => $newClientsChangeLastWeek,
        ]);
    }


    public function dailySalesChartData()
    {
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = Carbon::today()->subDays($i)->format('Y-m-d');
        }

        $currentUserId = auth()->id();

        $dailySales = array_map(function ($day) use ($currentUserId) {
            return DB::table('transactions')
                ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id')
                ->where('list_space_tbl.user_id', $currentUserId)
                ->whereDate('transactions.created_at', $day)
                ->sum('transactions.amount') ?: 0;
        }, $days);

        $labels = array_map(fn($day) => Carbon::parse($day)->format('M d'), $days);

        return response()->json([
            'dailySales' => array_reverse($dailySales),
            'labels' => array_reverse($labels),
        ]);
    }



    public function viewListSpace()
    {
        return view('coworker_side.listSpace');
    }

    public function viewmyCoworkingSpace(Request $request)
    {
        if ($request->ajax()) {
            $userId = auth()->id();

            $requests = DB::table('list_space_tbl')
                ->join('users', 'list_space_tbl.user_id', '=', 'users.id')
                ->select('list_space_tbl.*')
                ->where('list_space_tbl.user_id', $userId)
                ->get();

            return DataTables::of($requests)
                ->addColumn('actions', function ($row) {
                    $editUrl = route('editSpace', $row->id);
                    $addDeskUrl = route('addDesks', $row->id);
                    $addMeetingUrl = route('addMeetings', $row->id);
                    $str = "<button class='btn btn-outline-dark btn-sm me-2' onclick='window.location.href=\"$editUrl\"'><i class='bi bi-pencil-square'></i> Update</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='deleteSpace(\"{$row->id}\")'><i class='bi bi-trash'></i> Delete</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='viewSpaceDetails(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='window.location.href=\"$addDeskUrl\"'><i class='bi bi-plus-lg'></i> Add Desk</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='window.location.href=\"$addMeetingUrl\"'><i class='bi bi-plus-lg'></i> Add Meetings</button>";
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

        if (!empty($spaceDetails->additional_images)) {
            $additionalImages = json_decode($spaceDetails->additional_images);
            $spaceDetails->additional_images = array_map(function ($image) {
                return asset($image);
            }, $additionalImages);
        }

        if (!empty($spaceDetails->basics)) {
            $spaceDetails->basics = json_decode(stripslashes(trim($spaceDetails->basics, '"')));
        }

        if (!empty($spaceDetails->seats)) {
            $spaceDetails->seats = json_decode(stripslashes(trim($spaceDetails->seats, '"')));
        }

        if (!empty($spaceDetails->equipment)) {
            $spaceDetails->equipment = json_decode(stripslashes(trim($spaceDetails->equipment, '"')));
        }

        if (!empty($spaceDetails->facilities)) {
            $spaceDetails->facilities = json_decode(stripslashes(trim($spaceDetails->facilities, '"')));
        }

        if (!empty($spaceDetails->accessibility)) {
            $spaceDetails->accessibility = json_decode(stripslashes(trim($spaceDetails->accessibility, '"')));
        }

        if (!empty($spaceDetails->perks)) {
            $spaceDetails->perks = json_decode(stripslashes(trim($spaceDetails->perks, '"')));
        }

        $deskFields = DB::table('desk_fields')
            ->where('space_id', $id)
            ->select('duration', 'price', 'hours')
            ->get();

        // Fetch meeting fields based on space_id
        $meetingFields = DB::table('meeting_fields')
            ->where('space_id', $id)
            ->select('num_people', 'price', 'hours')
            ->get();

        // Attach desks and meetings to response
        $spaceDetails->desk_fields = $deskFields;
        $spaceDetails->meeting_fields = $meetingFields;

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

    // public function editSpace($id)
    // {
    //     $space = DB::table('list_space_tbl')->where('id', $id)->first();

    //     if (!$space) {
    //         return redirect()->back()->with('error', 'Space not found.');
    //     }

    //     $basics = json_decode(stripslashes(trim($space->basics, '"')), true);
    //     $seats = json_decode(stripslashes(trim($space->seats, '"')), true);
    //     // $equipment = json_decode($space->equipment, true);
    //     $equipment = json_decode(stripslashes(trim($space->equipment, '"')), true);
    //     $facilities = json_decode(stripslashes(trim($space->facilities, '"')), true);
    //     $accessibility = json_decode(stripslashes(trim($space->accessibility, '"')), true);
    //     $perks = json_decode(stripslashes(trim($space->perks, '"')), true);


    //     $additionalImages = $space->additional_images ? json_decode($space->additional_images, true) : [];

    //     $deskFields = json_decode($space->desk_fields, true);
    //     $meetingFields = json_decode($space->meeting_fields, true);

    //     // dd($space);
    //     // dd($equipment);

    //     return view('coworker_side.editSpace', compact('space', 'basics', 'seats', 'equipment', 'facilities', 'accessibility', 'perks', 'additionalImages', 'deskFields', 'meetingFields'));
    // }

    public function editSpace($id)
    {
        $space = DB::table('list_space_tbl')->where('id', $id)->first();

        if (!$space) {
            return redirect()->back()->with('error', 'Space not found.');
        }

        // Decode general fields
        $basics = json_decode(stripslashes(trim($space->basics, '"')), true);
        $seats = json_decode(stripslashes(trim($space->seats, '"')), true);
        $equipment = json_decode(stripslashes(trim($space->equipment, '"')), true);
        $facilities = json_decode(stripslashes(trim($space->facilities, '"')), true);
        $accessibility = json_decode(stripslashes(trim($space->accessibility, '"')), true);
        $perks = json_decode(stripslashes(trim($space->perks, '"')), true);
        $additionalImages = $space->additional_images ? json_decode($space->additional_images, true) : [];

        // Decode desk and meeting fields with enhanced logic
        $jsonWithObject = ['desk_fields', 'meeting_fields'];
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

        $deskFields = $space->desk_fields;
        $meetingFields = $space->meeting_fields;

        return view('coworker_side.editSpace', compact(
            'space',
            'basics',
            'seats',
            'equipment',
            'facilities',
            'accessibility',
            'perks',
            'additionalImages',
            'deskFields',
            'meetingFields'
        ));
    }


    public function updateSpace(Request $request, $id)
    {
        $request->validate([
            'headerImage' => 'nullable|mimes:png,jpg,jpeg,webp',
            'additionalImages.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'headerImage.mimes' => 'The header image must be a file of type: png, jpg, jpeg, webp.',
            'additionalImages.*.mimes' => 'Each additional image must be a file of type: png, jpg, jpeg, webp.',
            'additionalImages.*.max' => 'Each additional image may not be larger than 2MB.',
        ]);

        $space = DB::table('list_space_tbl')->where('id', $id)->first();
        if (!$space) {
            return response()->json(['error' => 'Space not found.'], 404);
        }

        if ($request->hasFile('headerImage')) {
            $file = $request->file('headerImage');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/header/';
            $file->move($path, $filename);
            $headerImagePath = $path . $filename;
        } else {
            $headerImagePath = $space->header_image;
        }

        $additionalImages = [];
        if ($request->hasFile('additionalImages')) {
            foreach ($request->file('additionalImages') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move('uploads/additional_images/', $imageName);
                $additionalImages[] = 'uploads/additional_images/' . $imageName;
            }
        } else {
            $additionalImages = json_decode($space->additional_images, true);
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
            'exceptions' => $request->input('exceptions'),
            'operating_hours_from' => $request->input('operatingHoursFrom'),
            'operating_hours_to' => $request->input('operatingHoursTo'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'instagram' => $request->input('instagram'),
            'facebook' => $request->input('facebook'),
            'contact_no' => $request->input('contactNo'),

            'basics' => json_encode($request->input('basics', [])),
            'seats' => json_encode($request->input('seats', [])),
            'equipment' => json_encode($request->input('equipment', [])),
            'facilities' => json_encode($request->input('facilities', [])),
            'accessibility' => json_encode($request->input('accessibility', [])),
            'perks' => json_encode($request->input('perks', [])),

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
            'meeting_rooms' => $request->input('meetingRooms'),
            'virtual_offices' => $request->input('virtualOffices'),
            'size' => $request->input('size'),
            'measurement_unit' => $request->input('measurementUnit'),
            'header_image' => $headerImagePath,
            'additional_images' => json_encode($additionalImages),
            'pay_online' => $request->input('payOnline'),
            'credit_cards' => $request->input('creditCards'),
            'eWallet' => $request->input('eWallet'),

            // 'desk_fields' => json_encode($request->input('desks', [])),
            // 'meeting_fields' => json_encode($request->input('meetingRooms', [])),
            'virtual_service' => $request->input('virtualService'),

            'membership' => $request->input('membership'),
            'membership_duration' => $request->input('membershipDuration'),
            'membership_price' => $request->input('membershipPrice'),
            'short_term' => $request->input('shortTerm'),
            'short_term_details' => $request->input('shortTermDetails'),
            'free_pass' => $request->input('freePass'),
            'free_pass_details' => $request->input('freePassDetails'),
            // 'price' => $request->input('price'),
            'user_id' => Auth::id(),
        ];

        DB::table('list_space_tbl')->where('id', $id)->update($data);

        return redirect()->route('myCoworkingSpace')->with('success', 'Space updated successfully.');
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
            'exceptions' => $request->input('exceptions'),
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
            // 'desk_fields' => json_encode($request->input('desks')),
            // 'meeting_fields' => json_encode($request->input('meeting_fields')),
            'virtual_service' => $request->input('virtualService'),
            'membership' => $request->input('membership'),
            'membership_duration' => $request->input('membershipDuration'),
            'membership_price' => $request->input('membershipPrice'),
            'short_term' => $request->input('shortTerm'),
            'short_term_details' => $request->input('shortTermDetails'),
            'free_pass' => $request->input('freePass'),
            'free_pass_details' => $request->input('freePassDetails'),
            // 'price' => $request->input('price'),
            'user_id' => Auth::id(),
        ];

        DB::table('list_space_tbl')->insert($data);

        return response()->json(['message' => 'Data inserted successfully.']);
    }

    // public function viewReviews()
    // {
    //     $reviews = DB::table('reviews')
    //         ->join('users', 'reviews.user_id', '=', 'users.id')
    //         ->join('list_space_tbl', 'reviews.cowork_id', '=', 'list_space_tbl.id')
    //         ->select('reviews.*', 'users.name as reviewer_name', 'list_space_tbl.space_name', 'list_space_tbl.header_image')
    //         ->get();

    //     if ($reviews->isEmpty()) {
    //         return view('coworker_side.reviews', [
    //             'reviews' => [],
    //             'totalReviews' => 0,
    //             'fiveStar' => 0,
    //             'fourStar' => 0,
    //             'threeStar' => 0,
    //             'twoStar' => 0,
    //             'oneStar' => 0,
    //             'averageRating' => 0,
    //         ]);
    //     }

    //     $reviews->transform(function ($review) {
    //         $review->created_at = Carbon::parse($review->created_at);
    //         return $review;
    //     });

    //     $totalReviews = $reviews->count();
    //     $fiveStar = $reviews->where('rating', 5)->count();
    //     $fourStar = $reviews->where('rating', 4)->count();
    //     $threeStar = $reviews->where('rating', 3)->count();
    //     $twoStar = $reviews->where('rating', 2)->count();
    //     $oneStar = $reviews->where('rating', 1)->count();

    //     $averageRating = $totalReviews > 0 ? $reviews->sum('rating') / $totalReviews : 0;

    //     return view('coworker_side.reviews', compact('reviews', 'totalReviews', 'fiveStar', 'fourStar', 'threeStar', 'twoStar', 'oneStar', 'averageRating'));
    // }


    public function viewReviews(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $sort = $request->input('sort', 'newest_to_oldest');

        $currentUserId = auth()->id();

        $query = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('list_space_tbl', 'reviews.cowork_id', '=', 'list_space_tbl.id')
            ->select(
                'reviews.*',
                'users.name as reviewer_name',
                'list_space_tbl.space_name',
                'list_space_tbl.header_image',
                'list_space_tbl.location', // Add location
                'list_space_tbl.operating_hours_from', // Add operating hours from
                'list_space_tbl.operating_hours_to', // Add operating hours to
                'reviews.review_body'
            )
            ->where('list_space_tbl.user_id', $currentUserId);

        if ($filter === 'positive') {
            $query->where('rating', '>=', 3);
        } elseif ($filter === 'critical') {
            $query->where('rating', '<=', 2);
        }

        if ($sort === 'newest_to_oldest') {
            $query->orderBy('reviews.created_at', 'desc');
        } elseif ($sort === 'oldest_to_newest') {
            $query->orderBy('reviews.created_at', 'asc');
        }

        $reviews = $query->get();

        $reviews = collect($reviews);

        if ($reviews->isEmpty()) {
            return view('coworker_side.reviews', [
                'reviews' => $reviews,
                'totalReviews' => 0,
                'fiveStar' => 0,
                'fourStar' => 0,
                'threeStar' => 0,
                'twoStar' => 0,
                'oneStar' => 0,
                'averageRating' => 0,
            ]);
        }

        // Calculate statistics
        $totalReviews = $reviews->count();
        $fiveStar = $reviews->where('rating', 5)->count();
        $fourStar = $reviews->where('rating', 4)->count();
        $threeStar = $reviews->where('rating', 3)->count();
        $twoStar = $reviews->where('rating', 2)->count();
        $oneStar = $reviews->where('rating', 1)->count();
        $averageRating = $totalReviews > 0 ? $reviews->sum('rating') / $totalReviews : 0;

        return view('coworker_side.reviews', compact(
            'reviews',
            'totalReviews',
            'fiveStar',
            'fourStar',
            'threeStar',
            'twoStar',
            'oneStar',
            'averageRating'
        ));
    }



    // public function filterReviews(Request $request)
    // {
    //     $query = DB::table('reviews');

    //     if ($request->has('filter_type') && $request->filter_type != 'All Reviews') {
    //         if ($request->filter_type == 'Positive') {
    //             $query->where('rating', '>=', 3);
    //         } elseif ($request->filter_type == 'Critical') {
    //             $query->where('rating', '<', 3);
    //         }
    //     }

    //     if ($request->has('sort_type')) {
    //         if ($request->sort_type == 'Newest to Oldest') {
    //             $query->orderBy('created_at', 'desc');
    //         } else {
    //             $query->orderBy('created_at', 'asc');
    //         }
    //     }

    //     $reviews = $query->get();

    //     return response()->json([
    //         'reviews' => $reviews
    //     ]);
    // }

    // public function viewReservations(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $requests = DB::table('transactions')
    //             ->select('*')
    //             ->get();

    //         return DataTables::of($requests)
    //             // ->addIndexColumn()
    //             ->addColumn('actions', function ($row) {
    //                 $statuses = ['PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED',];

    //                 $dropdown = "<div class='dropdown'>
    //                     <button class='btn btn-outline-dark btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
    //                         Change Status
    //                     </button>
    //                     <ul class='dropdown-menu'>";

    //                 foreach ($statuses as $status) {
    //                     $dropdown .= "<li>
    //                         <a class='dropdown-item status-btn' href='#' data-id='{$row->id}' data-status='{$status}'>
    //                             {$status}
    //                         </a>
    //                     </li>";
    //                 }

    //                 $dropdown .= "</ul></div>";

    //                 return $dropdown;
    //             })
    //             ->rawColumns(['actions'])
    //             ->make(true);
    //     }
    //     return view('coworker_side.reservations');
    // }

    public function viewReservations(Request $request)
    {
        if ($request->ajax()) {
            $userId = auth()->id();

            $status = $request->input('status', 'ALL');

            $query = DB::table('transactions')
                ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id')
                ->join('users', 'list_space_tbl.user_id', '=', 'users.id')
                ->select('transactions.*')
                ->where('list_space_tbl.user_id', $userId);

            if ($status !== 'ALL') {
                $query->where('transactions.status', $status);
            }

            $requests = $query->get();

            return DataTables::of($requests)
                ->addColumn('actions', function ($row) {
                    $statuses = ['PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED',];
                    $dropdown = "<select class='form-select form-select-sm change-status' data-id='{$row->id}'>
                                    <option value='' disabled selected>Change Status</option>";
                    foreach ($statuses as $status) {
                        $dropdown .= "<option value='{$status}'>{$status}</option>";
                    }
                    $dropdown .= "</select>";
                    return $dropdown;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('coworker_side.reservations');
    }


    public function getHours(Request $request)
    {
        $spaceType = $request->query('spaceType');
        $spaceId = $request->query('spaceId'); 

        if ($spaceType === 'desk') {
            $hours = DB::table('desk_fields')
                ->where('space_id', $spaceId)
                ->pluck('hours'); 
        } elseif ($spaceType === 'meeting_room') {
            $hours = DB::table('meeting_fields')
                ->where('space_id', $spaceId)
                ->pluck('hours');
        } else {
            return response()->json(['error' => 'Invalid space type'], 400);
        }

        return response()->json($hours);
    }

    public function updateStatus(Request $request)
    {
        $transactionId = $request->input('transaction_id');
        $newStatus = $request->input('status');

        $transaction = DB::table('transactions')->where('id', $transactionId)->first();

        if ($transaction) {
            DB::table('transactions')->where('id', $transactionId)->update(['status' => $newStatus]);

            //create notifications
            $notification = Notification::create([
                "space_id" => $transaction->space_id,
                "user_id" => $transaction->user_id,
                "transaction_id" => $transaction->id,
                "subject" => "Reservation " . ucwords(strtolower($newStatus)),
                "content" => "Your reservation is " . strtolower($newStatus) . ".",
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Transaction not found!',
        ]);
    }



    public function countFreePass()
    {
        $currentUserId = auth()->id();

        $freePassCount = DB::table('list_space_tbl')
            ->where('list_space_tbl.user_id', $currentUserId)
            ->where('free_pass', 'enable')
            ->count();

        return response()->json(['free_pass_count' => $freePassCount]);
    }


    public function showReservationTransactions()
    {
        $currentUserId = auth()->id();

        $allStatuses = ['PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', 'CANCELLED',];

        $existingStatuses = DB::table('transactions')
            ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id')
            ->where('list_space_tbl.user_id', $currentUserId)
            ->select('transactions.status', DB::raw('count(*) as count'))
            ->groupBy('transactions.status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = array_merge(array_fill_keys($allStatuses, 0), $existingStatuses);

        return response()->json($statuses);
    }



    public function getReservationTypeCounts()
    {
        $currentUserId = auth()->id();

        $deskCount = DB::table('desk_fields')
            ->join('list_space_tbl', 'desk_fields.space_id', '=', 'list_space_tbl.id')
            ->where('list_space_tbl.user_id', $currentUserId)
            ->whereNotNull('desk_fields.id')
            ->count();

        // Count meeting fields for the current user's spaces
        $meetingCount = DB::table('meeting_fields')
            ->join('list_space_tbl', 'meeting_fields.space_id', '=', 'list_space_tbl.id')
            ->where('list_space_tbl.user_id', $currentUserId)
            ->whereNotNull('meeting_fields.id')
            ->count();

        // Count virtual offices for the current user's spaces
        $virtualOfficesCount = DB::table('list_space_tbl')
            ->where('list_space_tbl.user_id', $currentUserId)
            ->whereNotNull('list_space_tbl.virtual_offices')
            ->count();

        // Occupied desk fields (transaction status is CONFIRMED) for the current user's spaces
        $occupiedDeskCount = DB::table('transactions')
            ->join('desk_fields', 'transactions.space_id', '=', 'desk_fields.space_id')
            ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id') // Join to check user ownership
            ->where('list_space_tbl.user_id', $currentUserId)
            ->where('transactions.status', 'CONFIRMED')
            ->count();

        // Occupied meeting rooms (transaction status is CONFIRMED) for the current user's spaces
        $occupiedMeetingCount = DB::table('transactions')
            ->join('meeting_fields', 'transactions.space_id', '=', 'meeting_fields.space_id')
            ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id') // Join to check user ownership
            ->where('list_space_tbl.user_id', $currentUserId)
            ->where('transactions.status', 'CONFIRMED')
            ->count();

        // Occupied virtual offices (transaction status is CONFIRMED) for the current user's spaces
        $occupiedVirtualOfficesCount = DB::table('transactions')
            ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id')
            ->where('list_space_tbl.user_id', $currentUserId)
            ->where('transactions.status', 'CONFIRMED')
            ->whereNotNull('list_space_tbl.virtual_offices')
            ->count();

        // Total occupied count
        $totalOccupiedCount = $occupiedDeskCount + $occupiedMeetingCount + $occupiedVirtualOfficesCount;

        // Total count (including unoccupied)
        $totalCount = $deskCount + $meetingCount + $virtualOfficesCount;

        return response()->json([
            'deskCount' => $deskCount,
            'meetingCount' => $meetingCount,
            'virtualOfficesCount' => $virtualOfficesCount,
            'occupiedDeskCount' => $occupiedDeskCount,
            'occupiedMeetingCount' => $occupiedMeetingCount,
            'occupiedVirtualOfficesCount' => $occupiedVirtualOfficesCount,
            'totalOccupiedCount' => $totalOccupiedCount,
            'totalCount' => $totalCount,
        ]);
    }

    public function replyToReview(Request $request, $reviewId)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        DB::table('replies')->insert([
            'cowork_id' => auth()->id(), // Assuming cowork_id represents the current user
            'user_id' => auth()->id(),   // Add user_id field
            'review_id' => $reviewId,
            'reply' => $request->input('reply'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Your reply has been posted!');
    }

    public function aboutUs()
    {
        return view('coworker_side.about_us');
    }

    public function addDesks($id)
    {
        $deskFields = DB::table('desk_fields')->where('space_id', $id)->get();
        return view('coworker_side.addDesks', compact('id', 'deskFields'));
    }


    // public function saveDesks(Request $request, $id)
    // {
    //     $request->validate([
    //         'inputs.*.duration' => 'required|string',
    //         'inputs.*.price' => 'required|numeric',
    //         'inputs.*.hours' => 'required|string',
    //     ]);

    //     foreach ($request->inputs as $input) {
    //         DB::table('desk_fields')->insert([
    //             'space_id' => $id,
    //             'duration' => $input['duration'],
    //             'price' => $input['price'],
    //             'hours' => $input['hours'],
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Desks added successfully.');
    // }

    public function saveDesks(Request $request, $id)
    {
        $request->validate([
            'inputs.*.duration' => 'required|string',
            'inputs.*.price' => 'required|numeric',
            'inputs.*.hours' => 'nullable|string',
        ]);

        $inputs = $request->input('inputs');

        foreach ($inputs as $key => $input) {
            if ($key !== 'new') {
                DB::table('desk_fields')->insert([
                    'space_id' => $id,
                    'duration' => $input['duration'],
                    'price' => $input['price'],
                    'hours' => $input['hours'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Desks added successfully.');
    }

    public function deleteDesk(Request $request, $id)
    {
        $deskId = $request->input('desk_id');

        if ($deskId && DB::table('desk_fields')->where('id', $deskId)->exists()) {
            DB::table('desk_fields')->where('id', $deskId)->delete();
            return response()->json(['status' => 'success', 'message' => 'Desk removed successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Desk not found']);
    }

    public function editDesk(Request $request, $id)
    {
        $deskId = $request->input('desk_id');
        $duration = $request->input('duration');
        $price = $request->input('price');
        $hours = $request->input('hours');

        DB::table('desk_fields')
            ->where('id', $deskId)
            ->update([
                'duration' => $duration,
                'price' => $price,
                'hours' => $hours,
                'updated_at' => now(),
            ]);

        return response()->json(['status' => 'success']);
    }


    public function addMeetings($id)
    {
        $meetingFields = DB::table('meeting_fields')->where('space_id', $id)->get();
        return view('coworker_side.addMeetings', compact('id', 'meetingFields'));
    }



    // public function saveMeetings(Request $request, $id)
    // {
    //     $request->validate([
    //         'inputs.*.numPeople' => 'required|string',
    //         'inputs.*.price' => 'required|numeric',
    //         'inputs.*.hours' => 'required|string',
    //     ]);

    //     foreach ($request->inputs as $input) {
    //         DB::table('meeting_fields')->insert([
    //             'space_id' => $id,
    //             'num_people' => $input['numPeople'],
    //             'price' => $input['price'],
    //             'hours' => $input['hours'],
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //     return redirect()->route('myCoworkingSpace')->with('success', 'Meetings added successfully.');
    // }


    public function saveMeetings(Request $request, $id)
    {
        $request->validate([
            'inputs.*.num_people' => 'required|string',
            'inputs.*.price' => 'required|numeric',
            'inputs.*.hours' => 'required|string',
        ]);

        $inputs = $request->input('inputs');

        foreach ($inputs as $key => $input) {
            if ($key !== 'new') {
                DB::table('meeting_fields')->insert([
                    'space_id' => $id,
                    'num_people' => $input['num_people'],
                    'price' => $input['price'],
                    'hours' => $input['hours'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return redirect()->back()->with('success', 'Meeting Room added successfully.');
    }

    public function deleteMeeting(Request $request, $id)
    {
        $meetingId = $request->input('meeting_id');

        if ($meetingId && DB::table('meeting_fields')->where('id', $meetingId)->exists()) {
            DB::table('meeting_fields')->where('id', $meetingId)->delete();
            return response()->json(['status' => 'success', 'message' => 'meeting removed successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'meeting not found']);
    }
    public function editMeeting(Request $request, $id)
    {
        $meetingId = $request->input('meeting_id');
        $num_people = $request->input('num_people');
        $price = $request->input('price');
        $hours = $request->input('hours');

        DB::table('meeting_fields')
            ->where('id', $meetingId)
            ->update([
                'num_people' => $num_people,
                'price' => $price,
                'hours' => $hours,
                'updated_at' => now(),
            ]);

        return response()->json(['status' => 'success']);
    }

    public function getTotalSpaceCounts()
    {
        // Get the total counts for each type of space
        $deskCount = DB::table('desk_fields')->count();
        $meetingRoomCount = DB::table('meeting_fields')->count();
        $virtualOfficeCount = DB::table('list_space_tbl')->whereNotNull('virtual_offices')->count();

        // Return the counts as a JSON response
        return response()->json([
            'deskCount' => $deskCount,
            'meetingRoomCount' => $meetingRoomCount,
            'virtualOfficeCount' => $virtualOfficeCount,
            'totalCount' => $deskCount + $meetingRoomCount + $virtualOfficeCount,
        ]);
    }

    public function getOccupancy()
    {
        $occupancy = DB::table('list_space_tbl as l')
            ->join('transaction as t', 'l.space_id', '=', 't.space_id')
            ->where('t.status', 'CONFIRMED')
            ->leftJoin('desk_fields as d', 'l.space_id', '=', 'd.space_id')
            ->leftJoin('meeting_fields as m', 'l.space_id', '=', 'm.space_id')
            ->select(
                'l.space_id',
                'l.virtual_offices',
                DB::raw('COUNT(d.desk_id) as total_desks'),
                DB::raw('COUNT(m.meeting_id) as total_meeting_rooms')
            )
            ->groupBy('l.space_id', 'l.virtual_offices')
            ->get();

        return response()->json($occupancy);
    }

}
