<?php

namespace App\Http\Controllers;

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
        // Current Date
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $lastWeekStart = $today->copy()->subWeek()->startOfDay();
        $lastWeekEnd = $today->copy()->subWeek()->endOfDay();

        // Calculate today's totals
        $todaysMoney = DB::table('transactions')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todaysClients = DB::table('users')
            ->whereDate('created_at', $today)
            ->count();

        $todaysNewClients = DB::table('users')
            ->whereDate('created_at', $today)
            ->count();

        // Total sales (sum of all amounts)
        $totalSales = DB::table('transactions')
            ->sum('amount');

        // Calculate last week's totals
        $lastWeekSales = DB::table('transactions')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('amount');

        // Calculate yesterday's totals
        $yesterdaysMoney = DB::table('transactions')
            ->whereDate('created_at', $yesterday)
            ->sum('amount');

        $yesterdaysSales = DB::table('transactions')
            ->whereDate('created_at', $yesterday)
            ->sum('amount');

        $yesterdaysClients = DB::table('users')
            ->whereDate('created_at', $yesterday)
            ->count();

        $yesterdaysNewClients = DB::table('users')
            ->whereDate('created_at', $yesterday)
            ->count();

        // Calculate last week's new clients
        $lastWeekNewClients = DB::table('users')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->count();

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

        $dailySales = array_map(function ($day) {
            return DB::table('transactions')
                ->whereDate('created_at', $day)
                ->sum('amount') ?: 0;
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
            $requests = DB::table('list_space_tbl')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                // ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $editUrl = route('editSpace', $row->id);
                    $str = "<button class='btn btn-outline-dark btn-sm me-2' onclick='window.location.href=\"$editUrl\"'><i class='bi bi-pencil-square'></i> Update</button>
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

        if (!empty($spaceDetails->desk_fields)) {
            $decodedDeskFields = json_decode($spaceDetails->desk_fields, true);
            if (is_array($decodedDeskFields)) {
                $deskFields = array_map(function ($field) {
                    return json_decode($field, true);
                }, $decodedDeskFields);
                $spaceDetails->desk_fields = $deskFields;
            } else {
                $spaceDetails->desk_fields = [];
            }
        } else {
            $spaceDetails->desk_fields = [];
        }

        if (!empty($spaceDetails->meeting_fields)) {
            $decodedMeetingFields = json_decode($spaceDetails->meeting_fields, true);
            if (is_array($decodedMeetingFields)) {
                $meetingFields = array_map(function ($field) {
                    return json_decode($field, true);
                }, $decodedMeetingFields);
                $spaceDetails->meeting_fields = $meetingFields;
            } else {
                $spaceDetails->meeting_fields = [];
            }
        } else {
            $spaceDetails->meeting_fields = [];
        }


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

    public function editSpace($id)
    {
        $space = DB::table('list_space_tbl')->where('id', $id)->first();

        if (!$space) {
            return redirect()->back()->with('error', 'Space not found.');
        }

        $basics = json_decode(stripslashes(trim($space->basics, '"')), true);
        $seats = json_decode(stripslashes(trim($space->seats, '"')), true);
        // $equipment = json_decode($space->equipment, true);
        $equipment = json_decode(stripslashes(trim($space->equipment, '"')), true);
        $facilities = json_decode(stripslashes(trim($space->facilities, '"')), true);
        $accessibility = json_decode(stripslashes(trim($space->accessibility, '"')), true);
        $perks = json_decode(stripslashes(trim($space->perks, '"')), true);


        $additionalImages = $space->additional_images ? json_decode($space->additional_images, true) : [];

        $deskFields = json_decode($space->desk_fields, true);
        $meetingFields = json_decode($space->meeting_fields, true);

        // dd($space);
        // dd($equipment);

        return view('coworker_side.editSpace', compact('space', 'basics', 'seats', 'equipment', 'facilities', 'accessibility', 'perks', 'additionalImages', 'deskFields', 'meetingFields'));
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
            'price' => $request->input('price'),
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
            'price' => $request->input('price'),
            'user_id' => Auth::id(),
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

    public function filterReviews(Request $request)
    {
        $query = DB::table('reviews');

        if ($request->has('filter_type') && $request->filter_type != 'All Reviews') {
            if ($request->filter_type == 'Positive') {
                $query->where('rating', '>=', 3);
            } elseif ($request->filter_type == 'Critical') {
                $query->where('rating', '<', 3);
            }
        }

        if ($request->has('sort_type')) {
            if ($request->sort_type == 'Newest to Oldest') {
                $query->orderBy('created_at', 'desc');
            } else {
                $query->orderBy('created_at', 'asc');
            }
        }

        $reviews = $query->get();

        return response()->json([
            'reviews' => $reviews
        ]);
    }

    public function viewReservations(Request $request)
    {
        if ($request->ajax()) {
            $requests = DB::table('transactions')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                // ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $statuses = ['PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', 'REFUNDED'];

                    $dropdown = "<div class='dropdown'>
                        <button class='btn btn-outline-dark btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            Change Status
                        </button>
                        <ul class='dropdown-menu'>";

                    foreach ($statuses as $status) {
                        $dropdown .= "<li>
                            <a class='dropdown-item status-btn' href='#' data-id='{$row->id}' data-status='{$status}'>
                                {$status}
                            </a>
                        </li>";
                    }

                    $dropdown .= "</ul></div>";

                    return $dropdown;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('coworker_side.reservations');
    }

    public function updateStatus(Request $request)
    {
        $transactionId = $request->input('transaction_id');
        $newStatus = $request->input('status');

        $transaction = DB::table('transactions')->where('id', $transactionId)->first();

        if ($transaction) {
            DB::table('transactions')->where('id', $transactionId)->update(['status' => $newStatus]);

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
        $freePassCount = DB::table('list_space_tbl')
            ->where('free_pass', 'enable')
            ->count();

        return response()->json(['free_pass_count' => $freePassCount]);
    }

    public function showReservationTransactions()
    {
        $allStatuses = ['PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', 'CANCELLED', 'REFUNDED'];

        $existingStatuses = DB::table('transactions')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = array_merge(array_fill_keys($allStatuses, 0), $existingStatuses);

        return response()->json($statuses);
    }


    public function getReservationTypeCounts()
    {
        $counts = DB::table('transactions')
            ->join('list_space_tbl', 'transactions.space_id', '=', 'list_space_tbl.id')
            ->select('list_space_tbl.meeting_rooms', 'list_space_tbl.virtual_offices')
            ->whereNotNull('list_space_tbl.meeting_rooms')
            ->orWhereNotNull('list_space_tbl.virtual_offices')
            ->get();

        $meetingRoomsCount = 0;
        $virtualOfficesCount = 0;

        foreach ($counts as $count) {
            if ($count->meeting_rooms) {
                $meetingRoomsCount++;
            }
            if ($count->virtual_offices) {
                $virtualOfficesCount++;
            }
        }

        return response()->json([
            'meetingRoomsCount' => $meetingRoomsCount,
            'virtualOfficesCount' => $virtualOfficesCount,
            'totalCount' => $meetingRoomsCount + $virtualOfficesCount,
        ]);
    }
}
