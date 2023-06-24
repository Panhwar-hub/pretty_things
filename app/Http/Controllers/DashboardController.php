<?php
namespace App\Http\Controllers;

use View;
use Illuminate\Support\Str;
use App\Models\inquiry;
use App\Models\Imagetable;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mytickets;
use App\Models\Ticketchat;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Route;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Album;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Matches;
use App\Models\Team;
use App\Models\Review;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Merchandise;
use App\Models\categories;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Booking;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $logo = imagetable::where('table_name','logo')->latest()->first();
        $user = User::where('id',Auth::id())->with('img_tab')->first();
        View()->share('logo',$logo);
        View()->share('user',$user);
        View()->share('config',$this->getConfig());
    }

    public function dashboard()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        //dd($user);
        return view('userdash.dashboard.index')->with('title','My Dashboard')->with(compact('user'))
        ->with('dashMenu',true);
    }

    public function myProfile()
    {
         $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        //dd($user);
        return view('userdash.dashboard.myprofile')->with('title','My Profile')->with(compact('user'))
        ->with('myProfileMenu',true);
    }

    public function editprofile()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        //dd($user);
        return view('userdash.dashboard.edit-profile')->with('title','Edit Profile')->with(compact('user'))
        ->with('myProfileMenu',true);
    }

    public function saveprofile(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            // 'bio' => 'required',
        ]);  
        
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        $user->fullname= $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
      
       
       
       

        if(request()->hasFile('avatar')){
           $avatar = request()->file('avatar')->store('Uploads/avatar/'.Auth::user()->id.rand().rand(10,100), 'public');
           $user->img_path = $avatar;
        //    $image = imagetable::updateOrCreate (
        //        [
        //         'ref_id' => $user->id,
        //         'table_name' => 'users',
        //        ],
        //     [
        //     'table_name' => 'users',
        //     'img_path' => $avatar,
        //     'ref_id' => $user->id,
        //     'type' => 1,
        //     'is_active_img'=>1,
        // ]);
         }
         $user->save(); 
        return redirect()->route('dashboard.editProfile')->with('notify_success','Profile Updated!');
    }

    public function myorders()
    {
        // dd();
        $orders = Orders::where('user_id',Auth::id())->with('orderHasDetail')->latest()->get();
          return view('userdash.dashboard.mybooking')->with('title','My Orders')->with(compact('orders'))
        ->with('mybookingMenu',true);
    }

    

    public function vieworders($decrypt)
    {
        // dd(Auth::id());
        $decrypted = Crypt::decryptString($decrypt);
        // $orders = Orders::where('id',$decrypted)->where('user_id',Auth::id())->with('rderHasDetail')->first();
        $orders=Orders::where('id',$decrypted)->where('user_id',Auth::id())->with('orderHasDetail')->first();
        // dd($orders);
       
        if(!empty($orders) && isset($orders))
        {
            $order_detail = unserialize($orders->orderHasDetail->details);
            return view('userdash.dashboard.viewbooking')->with('title','View Order')->with(compact('orders','order_detail'))->with('mybookingMenu',true);
        }
        else{
            return back()->with('notify_error', 'No Details Found!');
        }
    }

    public function deleteorders($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        //  $check_apt = Appointment::where('id',$decrypted)->first();
         $orders=Orders::where('id',$decrypted)->where('user_id',Auth::id())->with('orderHasDetail')->delete();
        // dd($check_apt);
        //  if($check_apt->is_active == 0)
        //  {
        //      $apt = Appointment::where('id',$decrypted)->with(['appointmentHasDetail','appointmentHasDocs'])->delete();
             return back()->with('notify_success', 'Order Deleted!');
        //  }
        //  else
        //  {
        //      return back()->with('notify_error', 'Error Deleting Appointment!!');
        //  }
    }

    public function mybookings()
    {
        $bookings = Booking::where('user_id',Auth::id())->get();
          return view('userdash.dashboard.orderbooking')->with('title','My Bookings')->with(compact('bookings'))
        ->with('orderbookingMenu',true);
    }

    public function mytickets()
    {
      
        $mytickets = Mytickets::where('user_id',Auth::id())->get();
          return view('userdash.dashboard.mytickets')->with('title','My Tickets')->with(compact('mytickets'))
        ->with('myticketsMenu',true);
    }

    public function addtickets()
    {
      
        
          return view('userdash.dashboard.add-tickets')->with('title','Create Tickets')
        ->with('myticketsMenu',true);
    }

    public function createtickets(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'subject' => 'required',
            'message' => 'required',
        ]);  
    
        if ($validator->passes()) {  
        $mytickets = Mytickets::create([
          
            'subject' => $request['subject'],
            'email' => $request['email'],
            'user_id' => $request['user_id'],  
           
           
        ]);

        $ticketchat = Ticketchat::create([
          
            'ticket_id' => $mytickets->id,
            'message' => $request['message'],
            'user_id' => $request['user_id'],           
           
        ]);
  
       

        if(request()->hasFile('file')){
           $filepath = request()->file('file')->store('Uploads/tickets/files/'.Auth::user()->id.rand().rand(10,100), 'public');
           $file = Ticketchat::where('id',$ticketchat->id)->update (
              
            [
            
            'file_path' => $filepath,
            
        ]);
         }
         return response()->json(['msg' => 'Tickect Genterated Successfully!', 'status' => 1]);
        }

        else
           {
           return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
               
           }
    }
    
    public function chatmessage(Request $request)
    {
        // dd($request->all());
         
    
       
        $ticketchat = Ticketchat::create([
          
            'ticket_id' => $request['ticket_id'],
            'message' => $request['message'],
            'user_id' => $request['user_id'],           
           
        ]);
  
        if(request()->hasFile('file')){
            $filepath = request()->file('file')->store('Uploads/tickets/files/'.Auth::user()->id.rand().rand(10,100), 'public');
            $file = Ticketchat::where('id',$ticketchat->id)->update (
               
             [
             
             'file_path' => $filepath,
             
         ]);
          }
       

         return response()->json(['status' => 1]);
    

       
    }
    


    public function viewticket($decrypt)
    {
        
        $decrypted = Crypt::decryptString($decrypt);
       
        $myticket = Mytickets::where('id',$decrypted)->first();
        $ticketchat=Ticketchat::where('ticket_id',$decrypted)->with('ticketBelongsTochat')->get();
        // dd($ticketchat);
        // dd($ticketchat);
       
        // if(!empty($orders) && isset($orders))
        // {
            // $order_detail = unserialize($orders->orderHasDetail->details);
            return view('userdash.dashboard.viewticket')->with('title','View Ticket')->with(compact('ticketchat','myticket'))->with('myticketsMenu',true);
        // }
        // else{
        //     return back()->with('notify_error', 'No Details Found!');
        // }
    }


    public function viewbookings($decrypt)
    {
        // dd(Auth::id());
        $decrypted = Crypt::decryptString($decrypt);
        // $orders = Orders::where('id',$decrypted)->where('user_id',Auth::id())->with('rderHasDetail')->first();
        $bookings=Booking::where('id',$decrypted)->where('user_id',Auth::id())->first();
        // dd($orders);
       
        // if(!empty($orders) && isset($orders))
        // {
            // $order_detail = unserialize($orders->orderHasDetail->details);
            return view('userdash.dashboard.vieworderbooking')->with('title','View Booking')->with(compact('bookings'))->with('orderbookingMenu',true);
        // }
        // else{
        //     return back()->with('notify_error', 'No Details Found!');
        // }
    }

    public function deletebookings($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        //  $check_apt = Appointment::where('id',$decrypted)->first();
         $bookings=Booking::where('id',$decrypted)->where('user_id',Auth::id())->delete();
        // dd($check_apt);
        //  if($check_apt->is_active == 0)
        //  {
        //      $apt = Appointment::where('id',$decrypted)->with(['appointmentHasDetail','appointmentHasDocs'])->delete();
             return back()->with('notify_success', 'Booking Deleted!');
        //  }
        //  else
        //  {
        //      return back()->with('notify_error', 'Error Deleting Appointment!!');
        //  }
    }
    public function ticketclosed($decrypt)
    {
        // dd(Auth::id());
        $decrypted = Crypt::decryptString($decrypt);
        // dd($decrypted);
      $myticket = Mytickets::where('id',$decrypted)->first();
      $myticket->is_active= 2;
      $myticket->save();

      return redirect()->route('dashboard.mytickets')->with('notify_success','Ticket Closed Successfuly!!');
         
    }


    public function passwordchange()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        return view('userdash.dashboard.password-change')->with('title','Change Password')->with(compact('user'))->with('passChangeMenu',true);
    }

    public function updatepassword(Request $request)
    {
       $validator = $request->validate([
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = User::where('id', Auth::id())->first();
        //dd($user); 
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect()->route('dashboard.passwordChange')->with('notify_success','Password Updated!');
    }


    // public function editprofile()
    // {
    //     $user = User::where('id',Auth::id())->with('img_tab')->first(); 
    //     //dd($user);
    //     return view('userdash.dashboard.edit-profile')->with('title','Edit Profile')->with(compact('user'))
    //     ->with('editProfileMenu',true);
    // }

    // public function saveprofile(Request $request)
    // {
    //     //dd($request->all());
    //     $request->validate([
    //         'fname' => 'required',
    //         'lname' => 'required',
    //         'dob' => 'required',
    //         'age' => 'required',
    //     ]);  
    //     $user = User::where('id',Auth::id())->with('img_tab')->first(); 
    //     $user->fname= $request->fname;
    //     $user->lname = $request->lname;
    //     $user->dob = $request->dob;
    //     $user->age = $request->age;
    //     if(null != $request->address)
    //     {
    //          $user->address = $request->address;
    //     }
    //     if(null != $request->zip_code)
    //     {
    //         $user->zip_code = $request->zip_code;
    //     }
    //     $user->save(); 

    //     if(request()->hasFile('avatar')){
    //        $avatar = request()->file('avatar')->store('Uploads/avatar/'.Auth::user()->id.rand().rand(10,100), 'public');
    //        $image = imagetable::updateOrCreate (
    //            [
    //             'ref_id' => $user->id,
    //             'table_name' => 'users',
    //            ],
    //         [
    //         'table_name' => 'users',
    //         'img_path' => $avatar,
    //         'ref_id' => $user->id,
    //         'type' => 1,
    //         'is_active_img'=>1,
    //     ]);
    //      }
    //     return redirect()->route('dashboard.editProfile')->with('message','Profile Updated!');
    // }

    // public function passwordchange()
    // {
    //     $user = User::where('id',Auth::id())->with('img_tab')->first(); 
    //     return view('userdash.dashboard.password-change')->with('title','Dashboard')->with(compact('user'))->with('passChangeMenu',true);
    // }

    // public function updatepassword(Request $request)
    // {
    //    $validator = $request->validate([
    //         'password' => 'required|same:password',
    //         'password_confirmation' => 'required|same:password',
    //     ]);
    //     $user = User::where('id', Auth::id())->first();
    //     //dd($user); 
    //     $user->password = bcrypt($request['password']);
    //     $user->save();
    //     return redirect()->route('dashboard.passwordChange')->with('message','Password Updated!');
    // }

   public function myWishlist()
   {
       $wishlist = Wishlist::where('user_id',Auth::id())->get();
    //   dd($wishlist);
       return view('userdash.dashboard.wishlist.index')->with('title','My Wishlist')->with('mywishlistMenu',true)->with(compact('wishlist'));
   }

    

}