<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Show the application's farmer login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFarmerLoginForm()
    {

        return view('farmer.login');
    }

    /**
     * Show the application's admin login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Show the application farmer registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFarmerRegistrationForm()
    {
        return view('farmer.register');
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $status = User::select('is_active')
            ->where('email', $request['email'])
            ->where('type', 'user')
            ->first();
        //        if ($status->is_active == 0) {
        //            return Redirect::to(URL::previous())->with('error', 'Your Account is Disable.')->withInput();
        //        }
        $remember_me = $request->input('remember_me') ? TRUE : FALSE;
        //        $auth = auth()->guard('admin');

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_active' => 1], $remember_me)) {
            Session::flash('success', 'Login Success');
            return redirect()->route('farmer.dashboard');
        } else {
            Session::flash('error', 'Invalid email/password or inactive.');
            return Redirect::to(URL::previous());
        }
    }

    public function userLoginAjax(Request $request)
    {
        $username = $request->email;
        $password = $request->password;

        $user = User::where('email', $username)->first();
        if ($request->ajax()) {
            $remember_me = $request->input('remember_me') ? TRUE : FALSE;
            if (Auth::guard('farmer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_active' => 1, 'type' => 'farmer'], $remember_me)) {
                return Response::json(array('status' => true, 'message' => 'Login Successfully', 'redirect' => 'farmer'), 200);
            } elseif (Auth::guard('user')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_active' => 1, 'type' => 'user'], $remember_me)) {
                return Response::json(array('status' => true, 'message' => 'Login Successfully', 'redirect' => 'user'), 200);
            }
            $status = User::select('is_active')
                ->where('email', $request->input('email'))
                ->where('type', 'user')
                ->first();
            if ($status) {
                if ($status->is_active == 0) {
                    return Response::json(array(
                        'status' => false,
                        'message' => 'Your Account is Inactive',
                    ), 400); // 400 being the HTTP code for an invalid request.

                }
            }
            return Response::json(array(
                'status' => false,
                'message' => 'Invalid Email/Password',
            ), 400); // 400 being the HTTP code for an invalid request.

        }

        //
    }

    public function FarmerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $status = User::select('is_active')
            ->where('email', $request['email'])
            ->where('type', 'farmer')
            ->first();
        if ($status->is_active == 0) {
            return Redirect::to(URL::previous())->with('error', 'Your Account is Disable.')->withInput();
        }
        $remember_me = $request->input('remember_me') ? TRUE : FALSE;
        $auth = auth()->guard('farmer');
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_active' => 1, 'type' => 'farmer'], $remember_me)) {
            Session::flash('success', 'Login Successfully');
            return redirect()->route('farmer.dashboard');
        } else {
            Session::flash('error', 'Invalid email/password .');
            return Redirect::to(URL::previous());
        }
    }

    public function farmerLogout()
    {
        Auth::guard('farmer')->logout();
        return redirect('/');
    }
    public function userLogout()
    {
        Auth::guard('user')->logout();
        return redirect('/');
    }

    public function farmerRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //            'last_name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required'
        ]);
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user) {
            return Redirect::to(URL::previous())->with('error', 'Email Already Taken.')->withInput();
        }
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
        }
        $user->password = bcrypt($request['password']);
        $user->last_login = Carbon::now();
        $user->type = 'farmer';
        $user->is_web = 1;
        //        $location = json_decode(file_get_contents('http://api.ipstack.com/' . \Request::ip() . '?access_key=a8dd21ef5b997c650ce9b402b5538960'));
        ////        dd($location);
        //        if ($location) {
        //            $user->lat = $location->latitude;
        //            $user->lng = $location->longitude;
        //            $user->country = $location->country_name;
        //            $user->city = $location->city;
        //            $user->zip_code = $location->zip;
        //        }

        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
        //        $viewData['name'] = $user->first_name . ' ' . $user->last_name;
        //        Mail::send('emails.register', $viewData, function ($m) use ($user) {
        //            $m->from(env('FROM_EMAIL'), 'Musician App');
        //            $m->to($user->email, $user->first_name)->subject('Confirmation Email');
        //        });
        $auth = auth()->guard('user');
        $remember = $request['remember_me'] ? TRUE : FALSE;
        if ($auth->attempt(['password' => $request['password'], 'email' => $request['email']], $remember)) {
            Session::flash('success', 'Register Successfully, Please Login');
            return redirect()->route('farmer.login');
            //            return redirect()->route('route.name', [$param]); redirect with paramer
        }
        //        return Redirect::to(URL::previous());
    }

    public function userRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //            'last_name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required'
        ]);
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user) {
            return Redirect::to(URL::previous())->with('error', 'Email Already Taken.')->withInput();
        }
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            $user = new User;
            $user->name = $request['name'];

            $user->email = $request['email'];
        }
        $user->password = bcrypt($request['password']);
        $user->last_login = Carbon::now();
        $user->type = 'user';
        $user->is_web = 1;
        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
        $auth = auth()->guard('user');
        $remember = $request['remember_me'] ? TRUE : FALSE;
        if ($auth->attempt(['password' => $request['password'], 'email' => $request['email']], $remember)) {
            Session::flash('success', 'Register Successfully, Please Login');
            return redirect()->route('login');
        }
        return Redirect::to(URL::previous());
    }
    public function userRegistrationAjax(Request $request)
    {
        // Setup the validator
        $message = ['password.required' => 'The new password field is required.'];
        $rules = array('name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'min:5|required|confirmed|max:191', 'password_confirmation' => 'required|max:191',);
        $validator = Validator::make(Input::all(), $rules, $message);
        // Validate the input and return correct response
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->toArray();
            return Response::json(array(
                'status' => false,
                'message' => $errors,
                'from' => 'validator'

            ), 400); // 400 being the HTTP code for an invalid request.
        }
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            $user = new User;
            $user->name = $request['name'];

            $user->email = $request['email'];
        }
        $remember = false;
        if ($request->has(['zip_code', 'address'])) {
            $user->zip_code = $request->zip_code;
            $user->address = $request->address;
        }
        if ($request->has('remember_me')) {
            $remember = $request['remember_me'] ? TRUE : FALSE;
        }

        $user->password = bcrypt($request['password']);
        $user->phone = $request->phone;
        $user->last_login = Carbon::now();
        $user->type = 'user';
        $user->is_web = 1;
        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
        $auth = auth()->guard('user');
        if ($auth->attempt(['password' => $request['password'], 'email' => $request['email']], $remember)) {
            return Response::json(array('status' => true, 'message' => 'Account Created, now your logged in...'), 200);
        } else {
            return Response::json(array('success' => false, 'message' => 'Something Went Wrong', 'from' => 'invalid'), 400);
        }
        //        return Redirect::to(URL::previous());
    }

    public function sendForgotPassword(Request $request)
    {
        //      
        //     dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            //                    'phone'=> 'required|phone|unique:users',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());

            return response()->json(array('success' => 0, 'message' => $errors));
        }


        $forgot_email = $request->email;
        $email = User::where('email', $forgot_email)->first();
        //        dd(env('mail_username',''));
        if ($email) {

            $forgot_token = md5(time());

            User::where('email', $forgot_email)->update(['forget_password_token' => $forgot_token]);

            $link = url('reset_password') . '/' . $forgot_token;
            $full_name = $email->name . ' ' . $email->last_name;
            Mail::send('email_template.forgot_password', ['full_name' => $full_name, 'link' => $link], function ($m) use ($email) {
                $full_name = $email->name . ' ' . $email->last_name;
                $m->from(env('MAIL_USERNAME', 'codingpixel1716@gmail.com'), 'Organic Food Forgot password');
                $to = $email->email;

                $m->to($email->email, $full_name)->subject('Password Reset link');
            });

            return response()->json(array('success' => 1, 'redirect' => '/', 'message' => 'Check your email to reset Password', 'redirect' => 'main_page'));
        } else {
            return response()->json(array('success' => 0, 'message' => 'Invalid Email Address'));
        }

        return response()->json(array('success' => 1, 'redirect' => '/', 'message' => 'Check your email to reset Password', 'redirect' => 'main_page'));
    }

    function resetPasswordView($token)
    {

        $name = [];
        $data['title'] = 'Organic Food | Home';
        $data['explore_categories'] = Category::with('countCategoryProducts')->limit(5)->get();
        //        dd($data['explore_categories'] );
        $data['products'] = Product::with('getRatings', 'getFeaturedImage', 'getProductImages', 'getUser')->orderBy('id', 'desc')->paginate(16);
        $data['farmers_id'] = DB::select('SELECT farm_id,COUNT(*) AS `count` FROM orders_farm GROUP BY farm_id ORDER BY COUNT(*) DESC LIMIT 10 ');
        //                 ->groupBy('farm_id')
        //                 ->get();
        //        dd($data['farmers_id']);    
        foreach ($data['farmers_id'] as $farm_id) {
            $name[] = $farm_id->farm_id;
        }
        //        dd($name)
        $data['farmers'] = User::whereIn('id', $name)->get();
        if (!isset($token) || $token == '') {
            $request->Session()->flash('error', 'Invalid link');
            return redirect(url('/'));
        }

        $data['title'] = 'Reset Password';
        $data['token'] = $token;
        $data['reset_model_open'] = 'modal';
        //        dd($token);
        return view('frontend.home.index', $data);
    }

    function postResetPassword(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [

            'password' => 'required|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());

            return response()->json(array('success' => 0, 'message' => $errors));
        }
        $token = $request->token;
        $user_record = User::where('forget_password_token', $token)->first();
        if ($user_record) {
            $request->validate([
                'password' => 'required|min:6'
            ]);
            $data = array('password' => bcrypt($request->password), 'forget_password_token' => '');

            if (User::where('forget_password_token', $token)->update($data)) {


                return response()->json(array('success' => 1, 'redirect' => '/', 'message' => 'Password changed successfully'));
            } else {

                return response()->json(array('success' => 1, 'message' => 'Sorry!there is some errors please try later.'));
            }
            $data['message'] = 'You have changed your password successfully.';
            return response()->json(array('success' => 0, 'redirect' => '/', 'message' => 'You have changed your password successfully.'));
        } else {

            return response()->json(array('success' => 0, 'redirect' => '/', 'message' => 'Link expired.'));
        }
    }
}
