<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoworkerController extends Controller
{
    public function viewDashboard()
    {
        return view('coworker_side.coworker');
    }
}