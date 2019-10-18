<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\FarmOrder;
use App\ContactForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller {

    public function orders() {
        $data['tab'] = 'orders';
        $data['orders'] = Order::where('user_id', Auth::user()->id)->with(['getFarm' => function($q) {
                        $q->withTrashed();
                    }])->get();

        $data['orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) {
                        $query->withTrashed();
                    }])->first();

        $data['trashed_orders'] = Order::where('user_id', Auth::user()->id)->with(['getFarm' => function($q) {
                        $q->onlyTrashed();
                    }])->get();
        $data['trashed_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) {
                        $query->onlyTrashed();
                    }])->first();
        $data['processing_orders'] = Order::where('user_id', Auth::user()->id)
                        ->with(['getFarm' => function ($query) {
                                $query->where('status', 'processing');
                            }])->get();
        $data['processing_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) {
                        $query->where('status', 'processing');
                    }])->first();
        $data['onhold_orders'] = Order::where('user_id', Auth::user()->id)
                        ->with(['getFarm' => function ($query) {
                                $query->where('status', 'onhold');
                            }])->get();
        $data['onhold_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) {
                        $query->where('status', 'onhold');
                    }])->first();
        $data['cancelled_orders'] = Order::where('user_id', Auth::user()->id)
                        ->with(['getFarm' => function ($query) {
                                $query->where('status', 'cancelled');
                            }])->get();
        $data['cancelled_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) {
                        $query->where('status', 'cancelled');
                    }])->first();

        return view('user.orders', $data);
    }

    public function orderDetail($id) {
//         dd($id);
        $data['order'] = FarmOrder::withTrashed()->where('id', $id)->with('getOrderProducts.getProduct.getUnit')->first();
//        dd( $data['order']);
        return view('user.order_detail', $data);
    }

    public function calendar($days) {
        $dt = Carbon::now()->addDays(-$days);
        $dt_now = Carbon::now();
        $date = $dt->toDateString();
        $date_now = $dt_now->toDateString();

        $data['days'] = $days;
        $data['tab'] = 'orders';
        $data['orders'] = Order::where('user_id', Auth::user()->id)->with(['getFarm' => function($q) use($date,$date_now) {
                        $q->withTrashed()
                        ->whereBetween('created_at', [$date, $date_now]);
                    }])->get();

        $data['orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) use($date,$date_now){
                        $query->withTrashed()
                        ->whereBetween('created_at', [$date, $date_now]);
                    }])->first();

        $data['trashed_orders'] = Order::where('user_id', Auth::user()->id)->with(['getFarm' => function($q)use($date,$date_now) {
                        $q->onlyTrashed()
                                ->whereBetween('created_at', [$date, $date_now]);
                    }])->get();
        $data['trashed_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) use($date,$date_now) {
                        $query->onlyTrashed()
                                ->whereBetween('created_at', [$date, $date_now]);
                    }])->first();
        $data['processing_orders'] = Order::where('user_id', Auth::user()->id)
                        ->with(['getFarm' => function ($query) use($date,$date_now) {
                                $query->where('status', 'processing')
                                        ->whereBetween('created_at', [$date, $date_now]);
                            }])->get();
        $data['processing_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) use($date,$date_now) {
                        $query->where('status', 'processing')
                                ->whereBetween('created_at', [$date, $date_now]);
                    }])->first();
        $data['onhold_orders'] = Order::where('user_id', Auth::user()->id)
                        ->with(['getFarm' => function ($query) use($date,$date_now) {
                                $query->where('status', 'onhold')
                                        ->whereBetween('created_at', [$date, $date_now]);
                            }])->get();
        $data['onhold_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) use($date,$date_now){
                        $query->where('status', 'onhold')
                                ->whereBetween('created_at', [$date, $date_now]);
                    }])->first();
        $data['cancelled_orders'] = Order::where('user_id', Auth::user()->id)
                        ->with(['getFarm' => function ($query) use($date,$date_now) {
                                $query->where('status', 'cancelled')
                                        ->whereBetween('created_at', [$date, $date_now]);
                            }])->get();
        $data['cancelled_orders_count'] = Order::where('user_id', Auth::user()->id)->withCount(['getFarm' => function ($query) use($date,$date_now) {
                        $query->where('status', 'cancelled')
                                ->whereBetween('created_at', [$date, $date_now]);
                    }])->first();
       
//        dd( $data['orders']);
        return view('user.orders', $data);
    }
 public function account(){
     $data['tab'] = 'account';
     $data['user']=User::where('id',Auth::user()->id)->first();
      return view('user.account', $data);
 }
  public function addAccount(Request $request){
//      dd($request->all());
       $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
//                    'phone'=> 'required|phone|unique:users',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());

            return redirect()->back()->with('error',$errors);
        }
     $data['tab'] = 'account';
     $data['user']=User::where('id',Auth::user()->id)->first();
      $data['user']->name=$request->first_name;
      $data['user']->last_name=$request->last_name;
      $data['user']->email=$request->email;
      $data['user']->address=$request->address;
      $data['user']->city=$request->city;
      $data['user']->country=$request->country;
      $data['user']->zip_code=$request->zip;
      $data['user']->phone=$request->phone;
      $data['user']->save();
      return redirect()->back()->with('success','Settings updated.',$data);
 }
     public function checkPassoword(Request $request) {

        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        if (Hash::check($request->password, $user->password)) {
//            $data= '1';
            return response()->json();
        } else {
            $data = '1';
            return response()->json($data);
        }
    }
   public function updatePassword(Request $request) {
    
        $user_id = Auth::id();
        if ($request->old_password) {

            $user = User::where('id', $user_id)->first();
            $user->password = bcrypt($request->new_password);
            $user->save();
       return redirect()->back()->with('success', 'Password updated Successfully');
        } else { 
//          
            return redirect()->back()->with('error', 'First Verify old password');
        }
    }
    
    public function contact(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',        
            'email' => 'required|email',
            'message'=> 'required',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());

            return redirect()->back()->with('error',$errors);
        }
        $contact_info = new ContactForm();
        $contact_info->name= $request->name;
        $contact_info->email= $request->email;
        $contact_info->phone= $request->phone;
        $contact_info->website= $request->website;
        $contact_info->comment= $request->message;
        $contact_info->save();
      
        $farmer_id = $request->farmer_id;
        $farmer = User::where('id', $farmer_id)->first();
        $full_name = $farmer->name . ' ' . $farmer->last_name;
         Mail::send('email_template.contact_form', ['full_name' => $full_name, 'contact' => $contact_info ], function ($m) use ($farmer) {
                $full_name = $farmer->name . ' ' . $farmer->last_name;
                $m->from(env('MAIL_USERNAME', 'codingpixel.test3@gmail.com'), 'Organic Food Contact Info');
                $m->to($farmer->email, $full_name)->subject('Contact');
            });
        return redirect()->back()->with('contact_message', 'Form Submitted Successfully');    

    }

}
