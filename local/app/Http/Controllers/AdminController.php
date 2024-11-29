<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Cowork;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeactivatedUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        $totalRevenue = Transaction::whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->sum('amount');
        $dailyRevenue = Transaction::whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->whereDay('created_at', Carbon::now()->day)
                                ->sum('amount');
        $totalCoworker = User::where('user_type', '=', 2)->count();
        $totalTransaction = Transaction::whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->count();
        $dailyTransaction = Transaction::whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->whereDay('created_at', Carbon::now()->day)
                                ->count();
        $totalUsers = User::all()->count();
        $totalDeactivated = DeactivatedUser::all()->count();
        $totalSpaces = Cowork::all()->count();

        return view('admin_side.admin', compact(
            'totalRevenue', 
            'dailyRevenue', 
            'totalCoworker', 
            'totalTransaction', 
            'dailyTransaction',
            'totalUsers',
            'totalDeactivated',
            'totalSpaces',
        ));
    }

    public function viewUsers(Request $request)
    {
        if ($request->ajax()) {
            $requests = DB::table('users')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                ->addColumn('actions', function ($row) {
                    $csrf = csrf_field();
                    $deactivateRoute = route('user.deactivate', $row->id);
                    $editRoute = route('user.edit', $row->id);

                    $str = "<div class='d-flex justify-content-center'>
                                <a href='{$editRoute}' class='btn btn-outline-dark btn-sm me-2'>
                                    <i class='bi bi-pencil-square'></i> Update
                                </a>

                                <form action='{$deactivateRoute}' method='POST' onsubmit='return confirm(\"Are you sure you want to deactivate this user?\");' style='display:inline;'>
                                    {$csrf}
                                    <button type='submit' class='btn btn-outline-dark btn-sm me-2'><i class='bi bi-archive'></i> Deactivate</button>
                                </form>

                                <button class='btn btn-outline-dark btn-sm me-2' onclick='viewUserDetails(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>
                            </div>";
                    return $str;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin_side.users');
    }


    public function createUser() {
        return view('admin_side.users.create');
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'contact' => 'required|string|max:15',
            'birthday' => 'required|date',
            'user_type' => 'required|integer|min:1|max:3',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Store the data in the database
        User::create($validatedData);

        return redirect()->route('users')->with('success', 'User saved successfully!');
    }


    public function editUser($id) {
        $user = User::findOrFail($id);

        return view('admin_side.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'contact' => 'required|string|max:15',
            'birthday' => 'required|date',
            'user_type' => 'required|integer',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->birthday = $request->birthday;
        $user->user_type = $request->user_type;
        $user->gender = $request->gender;
        $user->address = $request->address;

        // Only update password if it is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save the user
        $user->save();

        // Redirect back with success message
        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);

        // Transfer user data to deactivated_users table
        DeactivatedUser::create([
            'name' => $user->name,
            'email' => $user->email,
            'contact' => $user->contact,
            'birthday' => $user->birthday,
            'gender' => $user->gender,
            'address' => $user->address,
            'user_type' => $user->user_type,
            'email_verified_at' => $user->email_verified_at,
            'password' => $user->password,
            'remember_token' => $user->remember_token,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);

        // Delete the user from the users table
        $user->delete();

        return redirect()->back()->with('success', 'User has been deactivated and moved to deactivated_users.');
    }

    public function viewDeactivatedUsers(Request $request)
    {
        if ($request->ajax()) {
            $requests = DB::table('deactivated_users')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                ->addColumn('actions', function ($row) {
                    $csrf = csrf_field();
                    $reactivateRoute = route('user.reactivate', $row->id);
                    $deleteRoute = route('deactivated.delete', $row->id);

                    $str = "<div class='d-flex justify-content-center'>
                                <form action='{$reactivateRoute}' method='POST' onsubmit='return confirm(\"Are you sure you want to activate this user?\");' style='display:inline;'>
                                    {$csrf}
                                    <button type='submit' class='btn btn-outline-dark btn-sm me-2'><i class='bi bi-arrow-repeat'></i> Activate</button>
                                </form>
                                <form action='{$deleteRoute}' method='POST' onsubmit='return confirm(\"Are you sure you want to permanently delete this user?\");'
                                style='display:inline;'>
                                    {$csrf}
                                    <input type='hidden' name='_method' value='DELETE'>
                                    <button type='submit' class='btn btn-outline-dark btn-sm me-2'><i class='bi bi-trash'></i> Delete</button>
                                </form>
                            </div>";
                    return $str;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin_side.deactivated');
    }

    public function deleteUser($id) {
        $user = DeactivatedUser::findOrFail($id);
        $user->delete();

        return redirect()->route('deactivated')->with('success', 'User deleted successfully!');
    }

    public function reactivateUser($id)
    {
        // Retrieve the deactivated user by ID
        $deactivatedUser = DeactivatedUser::findOrFail($id);

        // Create a new user record in the users table with the deactivated user's details
        User::create([
            'name' => $deactivatedUser->name,
            'email' => $deactivatedUser->email,
            'contact' => $deactivatedUser->contact,
            'birthday' => $deactivatedUser->birthday,
            'gender' => $deactivatedUser->gender,
            'address' => $deactivatedUser->address,
            'user_type' => $deactivatedUser->user_type,
            'email_verified_at' => $deactivatedUser->email_verified_at,
            'password' => $deactivatedUser->password,
            'remember_token' => $deactivatedUser->remember_token,
            'created_at' => $deactivatedUser->created_at,
            'updated_at' => $deactivatedUser->updated_at,
        ]);

        // Delete the user from the deactivated_users table
        $deactivatedUser->delete();

        return redirect()->back()->with('success', 'User has been reactivated and moved back to users.');
    }

    public function viewClients(Request $request)
    {
        if ($request->ajax()) {
            $requests = DB::table('users')
                ->select('*')
                ->where('user_type', '=', '1')
                ->get();

            return DataTables::of($requests)
                // ->addIndexColumn()
                // ->addColumn('actions', function ($row) {
                //     $str = "<button class='btn btn-outline-dark btn-sm me-2'><i class='bi bi-pencil-square'></i> Update</button>
                //             <button class='btn btn-outline-dark btn-sm me-2' onclick='deleteUser(\"{$row->id}\")'><i class='bi bi-archive'></i> Archive</button>
                //             <button class='btn btn-outline-dark btn-sm me-2' onclick='viewUser(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>";
                //     return $str;
                // })
                // ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin_side.clients');
    }

    public function viewUserDetails($id)
    {
        $userDetails = DB::table('users')->where('id', $id)->first();

        if (!$userDetails) {
            return response()->json(['error' => 'Space not found.'], 404);
        }

        return response()->json($userDetails);
    }

    public function viewSpaces(Request $request) {
        if ($request->ajax()) {
            $requests = DB::table('list_space_tbl')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                ->addColumn('actions', function ($row) {

                    $str = "<div class='d-flex justify-content-center'>
                                <button class='btn btn-outline-dark btn-sm me-2' onclick='viewSpaceDetails(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>
                            </div>";
                    return $str;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin_side.spaces');
    }

    public function viewSpaceDetails($id)
    {
        $spaceDetails = Cowork::where('id', $id)->first();
    
        if (!$spaceDetails) {
            return response()->json(['error' => 'Space not found.'], 404);
        }
    
        return response()->json($spaceDetails);
    }

    public function viewTransactions(Request $request) {
        if ($request->ajax()) {
            $transactions = Transaction::with('cowork')
                ->select('*')
                ->get();

            return DataTables::of($transactions)
                ->addColumn('actions', function ($row) {

                    $str = "<div class='d-flex justify-content-center'>
                                <button class='btn btn-outline-dark btn-sm me-2' onclick='viewTransactionDetails(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>
                            </div>";
                    return $str;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin_side.transactions');
    }

    public function viewTransactionDetails($id)
    {
        $transactionDetails = Transaction::with('cowork')->where('id', $id)->first();

        if (!$transactionDetails) {
            return response()->json(['error' => 'Transaction not found.'], 404);
        }

        return response()->json($transactionDetails);
    }
}
