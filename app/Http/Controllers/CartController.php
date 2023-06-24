<?php

namespace App\Http\Controllers;
use Session;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\News;
use App\Models\Content;
use App\Models\Keywords;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Album;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Matches;
use App\Models\Team;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Merchandise;
use App\Models\OrderInquiry;
use Auth;
use Mail;
use Stripe;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
    public function __construct()
    {
         $logo = imagetable::where('table_name','logo')->latest()->first();
         View()->share('logo',$logo);
         View()->share('config',$this->getConfig());
    }

    public function cart()
    {
        $banner = Imagetable::where('table_name','cart-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('cart')->with('title','Cart')->with(compact('banner'));
    }
    
    public function checkout_course(Request $request)
    {
        $course_id = $request->course_id;
        $course = Course::where('id', $course_id)->with('courseBelongsToState')->first();
        if($course->courseBelongsToState->payment_collected == 0){
            $req_pre = $course->courseBelongsToState->req_perc;
            $quez = Quiz::where('user_id', Auth::id())->where('course_id', $course_id)->latest()->first();
            if($quez){
                if($req_pre >= $quez->percentage){
                    return redirect()->route('checkout')->with('notify_error', 'You can’t add this course in the cart, do the quiz first and pass it with '.$req_pre.', than try again');
                }
            }
        }

        if(Session::has('cart') && !empty(Session::get('cart')))
        {
            Session::forget('cart');
        }
        
        $qty = $request->quantity;
        $cart = array();
        $cartId = $course_id.$request->type;
                
        if($qty == 0){
            $qty = 1;
        }
        
        if($course_id != "" && intval($qty) > 0)
        {
            if(!empty($cartId) && !empty($cart))
            {
                unset($cart[$cartId]);
            }
            $type = $request->type;
            $course = Course::where('id',$course_id)->first();
            $cart[$cartId]['cart_id'] = $cartId;
            $cart[$cartId]['course_id'] = $course_id;
            $cart[$cartId]['title'] = $course->title;
            $cart[$cartId]['delivery_method'] = $request->delivery_method;
            $cart[$cartId]['per_hour'] = $request->per_hour;
            $cart[$cartId]['type'] = $type;
            $cart[$cartId]['price'] = $course->$type;
            $cart[$cartId]['quantity'] = $qty;
            $cart[$cartId]['sub_total'] = floatval(($course->$type+$request->per_hour)*$qty);
            
            Session::put('cart',$cart);
            return redirect()->route('checkout')->with('notify_success', 'Item Added to cart Successfully');
        }
        else
        {
            return back()->with('notify_error', 'Something Went Wrong, Please Try Again!');
        }
        
    }

    public function save_cart(Request $request)
    {
        if(Session::has('cart') && !empty(Session::get('cart')))
        {
           $rowid = null;
           $flag = 0;
           $cart_data = Session::get('cart');
            foreach ($cart_data as $key => $value) 
            {
                if($key != 'billing_address'){
                    if((intval($value['product_id']) == intval($request['product_id'])))
                    {
                        $flag = 1;
                        $rowid = $value['cart_id'];
                        $cart_data[$rowid]['quantity'] += $request['quantity'];
                        $cart_data[$rowid]['sub_total'] = $cart_data[$rowid]['price']*$cart_data[$rowid]['quantity'];
           
                        Session::forget($rowid);
                        Session::put('cart',$cart_data); 
    
                        // return redirect()->route('courses')->with('notify_success','Product Added To Cart Successfully!');
                        return redirect()->route('cart')->with('notify_success','Product Added To Cart Successfully!');
                    }
                }
            }
        }
        
        $product_id = $request->product_id;
        $qty = $request->quantity;
        
        $cart = array();
        $cartId = $product_id.$request->type;
        if(Session::has('cart')){
            $cart = Session::get('cart');
        }
        
        if($qty == 0){
            $qty = 1;
        }
        
        if(intval($qty) > 0)
        {
            if(!empty($cartId) && !empty($cart))
            {
                unset($cart[$cartId]);
            }
            $type = $request->type;
            $product = Products::where('id',$product_id)->first();
            $cart[$cartId]['cart_id'] = $cartId;
            $cart[$cartId]['product_id'] = $product_id;
            $cart[$cartId]['price'] = $product->new_price;
            $cart[$cartId]['quantity'] = $qty;
            $cart[$cartId]['sub_total'] = floatval($product->new_price*$qty);
            
            Session::put('cart',$cart);
            // return redirect()->route('courses')->with('notify_success', 'Item Added to cart Successfully');
            return redirect()->route('cart')->with('notify_success', 'Item Added to cart Successfully');
        }
        else
        {
            return back()->with('notify_error', 'Something Went Wrong, Please Try Again!');
        }
        
    }

    public function updatecart(Request $request)
    {
        $rowid = $request->rowid;
        $qty = $request->qty;
        $cart_data = Session::get('cart');
        $cart_data[$rowid]['quantity'] = $qty;
        $pro = Products::where('id', $cart_data[$rowid]['product_id'])->first();
        $cart_data[$rowid]['sub_total'] = $pro['new_price']*$qty;
        Session::forget($rowid);
        Session::put('cart',$cart_data);

        return response()->json(['status' , 1]);
    }

    public function removecart(Request $request)
    {
        $rowid = $request['rowid'];
        $cart_data = Session::get('cart');
        unset($cart_data[$rowid]);
        Session::forget('cart');
        Session::put('cart',$cart_data);
    }
    
    public function checkout()
    {
        if(Auth::check())
        {
            if(Session::has('cart') && !empty(Session::get('cart')) )
            {
                $banner = Imagetable::where('table_name','checkout-banner')->latest()->first();
                $cart_data = Session::get('cart');
                return view('checkout')->with('title','Checkout')->with(compact('banner','cart_data'));
            }
            else{
                return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
            }
        }
        else
        {
            return back()->with('notify_error','You need to login first!');
        }
    }

    public function placeorder(Request $request)
    {
        if(Session::has('cart'))
        {
            $ser = Session::get('ser');
            $validator = $request->validate([
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'country' => 'required|max:255',
                'address' => 'required|max:255',
                'town' => 'required|max:255',
                'state' => 'required|max:255',
                'zip' => 'required|max:255',
                'phone' => 'required|max:255',
                'email' => 'required|email|max:255',
            ]);
       
            $order = Orders::create([
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'country' => $request['country'],
                'address' => $request['address'],
                'town' => $request['town'],
                'state' => $request['password'],
                'zip' => $request['zip'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'note' => $request['note'],
                'total_amount' => $request['total_amount'],
                'order_amount' => $request['total_amount'],
                'user_id' => Auth::id(),
            ]);

            $order_detail = OrderDetail::create([
                'details' => $ser,
                'order_id' => $order->id
            ]);
            Session::put('order_id',$order->id);
            $order_detail = unserialize($ser);
            $mail_data = array('orders' => $order, 'order_detail' => $order_detail, 'request' => $request->all());
            Session::put('mail_data',$mail_data);
            return redirect()->route('paysecure')->with('notify_success','Please Pay To Complete Your Order!');
        }
        else
        {
            return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
        }
    }
    
    public function stripePost(Request $request)
    {
        $cart_data = Session::get('cart');
        $cart_data['billing_address'] = $request->all();
        Session::put('cart',$cart_data);
        
        $amount = $request->total_amount;
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
            $stripe = \Stripe\PaymentIntent::create([
                'amount' => $request->total_amount*100,
                'currency' => 'usd',
                'transfer_group' => "ORDER_95",
            ]);
            $secret = $stripe->client_secret;

            return view('placeorder')->with('notify_success','Payment Charged Successfully!')->with(compact('secret', 'amount'));
            
        } catch(\Stripe\Exception\CardException $e) {
            return back()->with('notify_error',"a ".$e->getError()->message);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return back()->with('notify_error',"b ".$e->getError()->message);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return back()->with('notify_error',"c ".$e->getError()->message);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return back()->with('notify_error',"d ".$e->getError()->message);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return back()->with('notify_error',"e ".$e->getError()->message);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return back()->with('notify_error',"f ".$e->getError()->message);
        } catch (Exception $e) {
            return back()->with('notify_error',"g ".$e->getError()->message);
        }
       
    }

    public function order_submit()
    {
        if(Session::has('cart'))
        {
            $cart_data = Session::get('cart');
            $ser = Session::get('ser');
            $order = Orders::create([
                'user_id'           => Auth::id(),
                'fname'             => $cart_data['billing_address']['fname'],
                'lname'             => $cart_data['billing_address']['lname'],
                'country'           => $cart_data['billing_address']['country'],
                'address'           => $cart_data['billing_address']['address'],
                'town'              => $cart_data['billing_address']['town'],
                'state'             => $cart_data['billing_address']['state'],
                'zip'               => $cart_data['billing_address']['zip'],
                'phone'             => $cart_data['billing_address']['phone'],
                'email'             => $cart_data['billing_address']['email'],
                'shipment_value'    => $_GET['payment_intent'],
                'shipment_charges'  => $_GET['payment_intent_client_secret'],
                'total_amount'      => $cart_data['billing_address']['total_amount'],
                'order_amount'      => $cart_data['billing_address']['total_amount'],
                'redirect_status'   => $_GET['redirect_status'],
            ]);
            
            $order_detail = OrderDetail::create([
                'details' => $ser,
                'order_id' => $order->id
            ]);
   
            $uns = unserialize($ser);
            unset($uns['billing_address']);

            $amount = $order['total_amount'];
            $order_detail = [];
            foreach ($uns as $key => $val) {
                $product = Products::where('id', $val['product_id'])->first();
                $order_detail[] = array(
                    'product_id'         => $val['product_id'],
                    'name'              => $product['name'],
                    'price'             => $product['new_price'],
                    'quantity'          => $val['quantity'],
                    'sub_total'         => $val['sub_total'],
                );
            }

            $user = User::where('id', Auth::id())->first();
            // Mail::send('invoice', ['orders'=>$order,'order_detail'=>$order_detail], function($message) use ($order,$order_detail) {
            //     $message->to(env('MAIL_FROM_ADDRESS'));
            //     $message->cc(Auth::user()->email);
            //     $message->subject('Your Order Invoice');
            // });
            $banner = Imagetable::where('headings','$order_detail')->latest()->first();
            return view('checkout-landing')->with('title','Order Complete')->with(compact('banner'));
        }
        else{
            return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
        }
    }

    public function paysecure()
    {
        if(Session::has('cart'))
        {
            $order_id = Session::get('order_id');
            $custom = $order_id;
            $orders = Orders::where('id',$order_id)->with('orderHasDetail')->first()->toArray();
            $ser = Session::get('ser');
            $uns = unserialize($ser);
            $amount = $orders['total_amount'];
            foreach ($uns as $key => $val) {
                $product = Products::where('id', $val['product_id'])->first();
                $data1[] = array(
                    'product_id'         => $val['product_id'],
                    'name'              => $product['name'],
                    'price'             => $product['new_price'],
                    'quantity'          => $val['quantity'],
                    'sub_total'         => $val['sub_total'],
                );
            }
            $itemsss = $data1;
            $banner = Imagetable::where('table_name','checkout-landing-banner')->latest()->first();
            return view('paysecure')->with('title','Payment')->with(compact('banner','order_id','uns','amount','orders','itemsss','custom'));
        }
        else{
            return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
        }
    }

    public function paystatus(Request $request)
    {
        $status_codes = array("Default" => 0, "Completed" => 1, "Pending" => 2, "Denied" => 3, "Failed" => 4, "Reversed" => 5);
        $payment_status = $request['payment_status'];
        $updateParam = $status_codes[$payment_status];
        $order_upd = Orders::where('id',$request['custom'])->update([
            'pay_status' => $updateParam,
            'order_response' => serialize($request->all()),
            'order_merchant' => 'PAYPAL'
        ]);
            
    }

    public function checkout_landing()
    {
        if(Session::has('cart'))
        {
            $order_id = Session::get('order_id');
            $ser = Session::get('ser');
            $uns = unserialize($ser);

            $mail_data = Session::get('mail_data');
            $orders = $mail_data['orders'];
            $order_detail = $mail_data['order_detail'];
            $request = $mail_data['request'];
            Mail::send('invoice', ['orders'=>$orders,'order_detail'=>$order_detail]
                ,function($message) use ($orders,$order_detail,$request) {
                $message->to($request['email']);
                $message->subject('Your Order Invoice');
            });
         
            $banner = Imagetable::where('table_name','checkout-landing-banner')->latest()->first();
            return view('checkout-landing')->with('title','Order Complete')->with(compact('banner'));
        }
        else
        {
            return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
        }
    }
   
    public function order_inquiry(Request $request)
    {
        $product = Products::where('id', $request->product_id)->first();
        unset($request['_token']);
        
        $config = $this->getConfig('file_type');
        $currenturl = url('products-detail/'.$product->slug);
        
        OrderInquiry::create([
            'product_id'    => $request->product_id,
            'type'          => $request->select_stock,
            'fname'         => $request->fname,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'quantity'      => $request->quantity,
            'city'          => $request->city,
            'country'       => $request->country,
            'address'       => $request->address,
            'zip_code'      => $request->zip_code,
            'message'       => $request->message,
        ]);
        $email = $config['EXTERNALEMAIL'];
        
        Mail::send('order_inquiry', ['product'=>$product,'request'=>$request->all(), 'url'=>$currenturl]
            ,function($message) use ($product,$request,$currenturl, $email) {
              $message->to($email);
              $message->subject('Your Order Inquiry');
        });
        
        Mail::send('user_order_inquiry', ['url'=>$currenturl, 'request'=>$request]
            ,function($message) use ($request) {
              $message->to($request->email);
              $message->subject('Your Order Inquiry');
        });

        return response()->json(['status' , 1]);
    }
}
