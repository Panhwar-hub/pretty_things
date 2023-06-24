<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Wishlist;
use App\Models\Products;
use App\Models\Config;
use App\Models\Review;

use App\Models\Password_resets;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    public function __construct()
    {
        $logo = imagetable::where('table_name','logo')->latest()->first();
        View()->share('logo',$logo);
        View()->share('config',$this->getConfig());
    }
    
    public function signin()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','login')->latest()->first();
        return view('sign-in')->with('title','Login')->with(compact('banner'))->with('login_menu',true);
    }

    public function signin_submit(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:50',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if(Session::has('cart'))
            {
                return redirect()->route('checkout')->with('notify_success','Logged In!');
            }
            else
            {
                return redirect()->route('home')->with('notify_success','Logged In!');
            }
        }
        else
        {
            return back()->with('notify_error','Invalid Credentials');
        }
    }

    public function signup()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','sign-up')->latest()->first();
        return view('sign-up')->with('title','Sign Up')->with(compact('banner'))->with('login_menu',true);
    }

    public function signup_submit(Request $request)
    {
        $validator = $request->validate([
            'fullname' => 'required|max:255',
            'password' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255|',
        ]);

        $user = User::create([
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('notify_success','Logged In!');
    }

    public function signout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home')->with('notify_success','Logged Out!');
    }

    public function contact_us_submit(Request $request)
    {
        $validator = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone'=> 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $inquiry = Inquiry::create([
            'fname'=> $request['fname'],
            'lname'=> $request['lname'],
            'email'=> $request['email'],
            'phone'=> $request['phone'],
            'message'=> $request['message']
        ]);

        //   $data = [
        //         'no-reply' => $request->get('email'),
        //         'fname'    => $request->get('fname'),
        //         'lname'    => $request->get('lname'),
        //         'email'    => $request->get('email'),
        //         'subject'    => $request->get('subject'),
        //         'message'    => $request->get('message'),
        //     ];
   
        //   \Mail::send('email.contact-temp', ['data' => $data],function ($message) use ($data){
        //         $message
        //             ->from($data['no-reply'])
        //             ->to($external_email['flag_value'])->subject('Inquiry|Edusaurus');
              
        //   });

    
        return redirect()->route('home')->with('notify_success','Inquiry Submitted!');
    }
    
    public function showForgetPasswordForm()
    {
        $banner = Imagetable::where('table_name','forgetpassword-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('forgot-password')->with('title','Forget Password')->with(compact('banner'));
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
      
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
        Mail::send('reset-password', ['token' => $token ,'request'=>$request], function($message) use($request){
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        
        return back()->with('notify_success', 'We have e-mailed your password reset link!');
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->latest()->first();
        if(!$updatePassword){
            return back()->withInput()->with('notify_error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect()->route('sign-in')->with('notify_success', 'Your password has been changed!');
    }

    public function showResetPasswordForm($token) { 
        $reset_email =  password_resets::where('token',$token)->first();
        $banner = Imagetable::where('table_name','forgetpassword-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('resetpasswordform', ['token' => $token,'email' => $reset_email])->with(compact('reset_email','banner'));
     }
    
    public function addToWishlist(Request $request)
    {
        $product =Products::where('id',$request->productid)->where('is_active',1)->first();
        $wishlist = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->productid)->first();
        if(isset($wishlist) && !empty($wishlist)){
            $param = ['status'=>2,'msg'=>'Product Is Already In Your Wishlist'];
            return response()->json($param);
        }else{
            $wishlist = Wishlist::create([
                'user_id'=>Auth::id(),
                'product_id'=>$product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->sale_price,
                'img_path' => $product->img_path,
                /*'keyword_id'=>$request->keyword_id,
                'crawl_url'=>$request->crawl_url,
                'result_description'=>$request->result_description,*/
            ]);
            $param = array();
            $param['status'] = 1;
            echo json_encode($param);
        }
    }
    
    public function removeFromWishlist(Request $request)
    {
        $wishlist = Wishlist::where('product_id',$request->productid)->where('user_id',Auth::id())->delete();
        $param = array();
        $param = ['status'=>1,'msg'=>'Product Removed From Wishlist'];
            echo json_encode($param);
    }
   
}
