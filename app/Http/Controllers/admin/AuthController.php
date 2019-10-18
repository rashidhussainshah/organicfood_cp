<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.dashboard_content');
            //            return redirect('admin_dashboard?signup_stats_filter=daily');
        } else {
            $data['title'] = 'Admin Login';
            return view('admin.login', $data);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $auth = auth()->guard('admin');
        if ($auth->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('admin.dashboard');
            //            return redirect('admin_dashboard?signup_stats_filter=daily');
        } else {
            Session::flash('error', 'Invalid email or password.');
            return Redirect::to(URL::previous());
        }
    }

    public function adminLoginAjax(Request $request)
    {
        if ($request->ajax()) {
            $remember_me = $request->input('remember_me') ? TRUE : FALSE;
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
                return Response::json(array('status' => true, 'message' => 'Login Successfully'), 200);
            } else {
                return Response::json(array(
                    'status' => false,
                    'message' => 'Invalid Email/Password',
                ), 400); // 400 being the HTTP code for an invalid request.
            }
        }
    }

    public function showDashboard()
    {
        return view('admin.dashboard_content');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form');
    }
}
