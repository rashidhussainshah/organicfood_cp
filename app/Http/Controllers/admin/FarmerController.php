<?php

namespace App\Http\Controllers\admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use File;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $data['users'] = User::where('type', 'farmer')->get();
        $data['title'] = 'Farmer';
        return view('admin.farmer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Farmer';
        return view('admin.farmer.add_user', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $image_path = addFile($request->user_image, 'public/images/user_images/');
        if ($image_path == FALSE)
        {
            return redirect()->back()->with('error','Invalid File Selection.');
        }
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            $user = new User;
            $user->name = $request['name'];

            $user->email = $request['email'];
        }
        $user->profile_photo = $image_path;
        $user->password = bcrypt($request['password']);
        $user->is_active = $request['status'];
        $user->last_login = Carbon::now();
        $user->type = 'farmer';
        $user->is_web = 1;
        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
        return \redirect()->route('farmer.index')->with('success', 'Farmer Register Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['user'] = User::where('id', $id)->first();
        $data['title'] = 'Edit Farmer';
        return view('admin.farmer.edit_user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
//            'last_name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::where('id', $id)->first();
        if($request->has('user_image'))
        {
            if($user->profile_photo != '')
            {
                if (File::exists($user->profile_photo)) {
                    File::delete($user->profile_photo);
                }

            }
            $image_path = addFile($request->user_image, 'public/images/user_images/');
            if ($image_path == FALSE)
            {
                return redirect()->back()->with('error','Invalid File Selection.');
                $user->profile_photo =$image_path;
            }

        }
        
        if($user->email != $request['email'])
        {
            $user->email = $request['email'];

        }

        $user->name = $request['name'];
      
        $user->is_active = $request['status'];
        $user->password = bcrypt($request['password']);
        $user->last_login = Carbon::now();
        $user->type = 'farmer';
        $user->is_web = 1;
        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
        return \redirect()->route('farmer.index')->with('success', 'Farmer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::where('id', $id)->delete()) {
            return redirect()->back()->with('success', 'Farmer Deleted Successfully ');
        }
    }
}
