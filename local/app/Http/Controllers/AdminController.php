<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        return view('admin_side.admin');
    }

    public function viewUsers(Request $request)
    {
        if ($request->ajax()) {
            $requests = DB::table('users')
                ->select('*')
                ->get();

            return DataTables::of($requests)
                // ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $str = "<button class='btn btn-outline-dark btn-sm me-2'><i class='bi bi-pencil-square'></i> Update</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='deleteUser(\"{$row->id}\")'><i class='bi bi-archive'></i> Archive</button>
                            <button class='btn btn-outline-dark btn-sm me-2' onclick='viewUserDetails(\"{$row->id}\")'><i class='bi bi-eye'></i> View</button>";
                    return $str;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin_side.users');
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
}
