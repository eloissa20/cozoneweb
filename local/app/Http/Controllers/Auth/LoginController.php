<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // public function login(Request $request)
    // {
    //     $input = $request->all();
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if(auth()->attempt(array('email' =>$input['email'], 'password' =>$input['password'])))
    //     {
    //         if (auth()->user()->user_type == "1"){
    //             return redirect()->route('client_side.viewClient');
    //         }
    //         else if (auth()->user()->user_type == "2"){
    //             return redirect()->route('coworker_side.viewDashboard');
    //         }
    //         else if (auth()->user()->user_type == "3"){
    //             return redirect()->route('admin_side.viewDashboard');
    //         }
    //         else{
    //             abort(404);
    //             // return redirect()->route('home');
    //         }
    //     }else{
    //         // $ErrorMsg = ' Invalid Email or Password';
    //         // return redirect()->back()->with(['ErrorMsg' => $ErrorMsg])->WithInput();
    //         return redirect()->back()
    //             ->withErrors(['password' => 'Invalid password or email. Please try again.']) // Error specifically for password
    //             ->withInput();
    //     }
    // }

    public function login(Request $request)
    {
        // Validate the request input
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            // Check the authenticated user's user_type and redirect accordingly
            switch (auth()->user()->user_type) {
                case "1": // Client
                    return redirect()->route('client_side.home');
                case "2": // Coworker
                    return redirect()->route('coworker_side.coworker');
                case "3": // Admin
                    return redirect()->route('admin_side.admin');
                default:
                    abort(404); // Abort if user_type is unexpected
            }
        } else {
            // Redirect back with a specific error message for invalid credentials
            return redirect()->back()
                ->withErrors(['password' => 'Invalid email or password. Please try again.'])
                ->withInput();
        }
    }

}