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
    // public function viewmyCoworkingSpace(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $requests = DB::table('list_space_tbl')
    //             ->select('*')
    //             ->get();
    //             dd($requests);

    //         return Datatables::of($requests)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 return '<button class="btn btn-outline-light">View</button>';
    //             })
    //             ->make(true);
    //     }

    //     return view('coworker_side.myCoworkingSpace');
    // }

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
                        <button class='btn btn-outline-dark btn-sm' ><i class='bi bi-trash'></i> Delete</button>";
                return $str;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('coworker_side.myCoworkingSpace');
}

    public function submitListSpace(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'headerImage' => 'nullable|mimes:png,jpg,jpeg,webp',
        ], [
            'headerImage.mimes' => 'The header image must be a file of type: png, jpg, jpeg, webp.',
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
            'tables' => $request->input('tables'),
            'capacity' => $request->input('capacity'),
            'meeting_rooms' => $request->input('meetingRoomsCount'),
            'virtual_offices' => $request->input('virtualOffices'),
            'size' => $request->input('size'),
            'measurement_unit' => $request->input('measurementUnit'),
            'header_image' => $path . $filename,
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

}