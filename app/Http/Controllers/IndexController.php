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
use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Wishlist;
use App\Models\Matches;
use App\Models\Team;
use App\Models\Review;
use App\Models\Question;
use App\Models\Vendor;
use Carbon\Carbon;
use Auth;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Variation;
use App\Models\Productvideos;
use App\Models\Merchandise;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Models\PaymentLogs;
use App\Models\Results;

class IndexController extends Controller
{
    public function __construct()
    {
        $logo = Imagetable::where('table_name','logo')->latest()->first();
        $all_categories = Category::where('is_active', 1)->latest()->get();
        View()->share('logo',$logo);
        View()->share('all_categories',$all_categories);
        View()->share('config',$this->getConfig());
    }

    public function index()
    {
        $banner1 = Imagetable::where('table_name','home-slider')->where('type',2)->latest()->get();
        $category = Category::where('is_active', 1)->latest()->paginate(12);
        $products = Products::where('is_active', 1)->with('productBelongsToCategory')->with('productsHasMultiImages')->paginate(8);
        return view('welcome')->with('title','Home')->with(compact('products','banner1', 'category'))->with('homemenu',true);
    }

    public function about_us()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','about-us')->latest()->first();
        return view('about-us')->with('title','About_us')->with(compact('banner'))
        ->with('about_us',true);
    }

    public function products()
    {
        if(isset($_GET['slug'])){
            $category = Category::where('slug', $_GET['slug'])->latest()->first();
            $products = Products::where('category_id', $category->id)->where('is_active', 1)->with('productBelongsToCategory')->with('productsHasMultiImages')->latest()->get();
        }else{
            $products = Products::where('is_active', 1)->with('productBelongsToCategory')->with('productsHasMultiImages')->latest()->get();
        }
        $category = Category::where('is_active', 1)->latest()->get();
        $banner = Imagetable::where('table_name','home-slider')->where('headings','Products')->latest()->first();
        return view('products')->with('title','Products')->with(compact('banner', 'products', 'category'))
        ->with('product',true);
    }

    public function contact_us()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','contact-us')->latest()->get();
        return view('contact-us')->with('title','Contact_us')->with(compact('banner'))
        ->with('contact_us',true);
    }

    public function cart()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','cart')->latest()->first();
        return view('cart')->with('title','Cart')->with(compact('banner'))
        ->with('cart',true);
    }

    public function checkout()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','checkout')->latest()->first();
        return view('checkout')->with('title','Checkout')->with(compact('banner'))
        ->with('checkout',true);
    }

    public function products_detail($slug=null)
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','products-detail')->latest()->first();
        $products = Products::where('is_active', 1)->with('productBelongsToCategory')->with('productsHasMultiImages')->latest()->paginate(8);
        $product = Products::where('slug', $slug)->where('is_active', 1)->with('productBelongsToCategory')->with('productsHasMultiImages')->first();
        return view('products-detail')->with(compact('products', 'product', 'banner'))->with('title','Products Detail')->with('products_detail',true);
    }

    public function privacy_policy()
    {
        $banner = Imagetable::where('table_name','home-slider')->where('headings','privacy-policy')->latest()->first();
        return view('privacy-policy')->with('title','Privacy Policy')->with(compact('banner'))
        ->with('privacy-policy',true);
    }

    public function paystatus(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($request->all(),[
            'owner' => 'required|max:255',
            'cvv' => 'required|max:255',
            'card_number' => 'required|max:255',
            'expiration_month' => 'required',
            'expiration_year' => 'required',
        ]);

        if ($validator->passes()) {
            /* Create a merchantAuthenticationType object with authentication details
            retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));

            // Set the transaction's refId
            $refId = 'ref' . time();
            $cardNumber = preg_replace('/\s+/', '', $input['card_number']);
            
            // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($cardNumber);
            $creditCard->setExpirationDate($input['expiration_year'] . "-" .$input['expiration_month']);
            $creditCard->setCardCode($input['cvv']);

            // Add the payment data to a paymentType object
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);

            // Create a TransactionRequestType object and add the previous objects to it
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount($input['amount']);
            $transactionRequestType->setPayment($paymentOne);

            // Assemble the complete transaction request
            $requests = new AnetAPI\CreateTransactionRequest();
            $requests->setMerchantAuthentication($merchantAuthentication);
            $requests->setRefId($refId);
            $requests->setTransactionRequest($transactionRequestType);

            // Create the controller and get the response
            $controller = new AnetController\CreateTransactionController($requests);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            if ($response != null) {
                if ($response->getMessages()->getResultCode() == "Ok") {
                    $tresponse = $response->getTransactionResponse();
                    if ($tresponse != null && $tresponse->getMessages() != null) {
                        $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                        $msg_type = "success_msg";    
                        $log = PaymentLogs::create([                                         
                            'amount' => $input['amount'],
                            'response_code' => $tresponse->getResponseCode(),
                            'transaction_id' => $tresponse->getTransId(),
                            'auth_id' => $tresponse->getAuthCode(),
                            'message_code' => $tresponse->getMessages()[0]->getCode(),
                            'name_on_card' => trim($input['owner']),
                            'quantity'=>1,
                            'order_id'=>$request['product_id']
                        ]);

                        $result_create = Results::create([
                            'product_id' => $request['product_id'],
                            'pay_status' => 1,
                            'user_id' => Auth::id(),
                            'order_response' => serialize($request->all()),
                            'order_merchant' => 'AUTHORIZE.NET'
                        ]);

                        $details = Session::get('details');

                        $details['result'] = $result_create;
                        Session::forget('details');
                        Session::put('details',$details);
                        
                        return response()->json(['msg'=>'Payment Charged Successfuly!','status' => 1]);
                  
                    } else {
                        $message_text = 'There were some issue with the payment. Please try again later.';
                        $msg_type = "error_msg";                                    
                        
                        if ($tresponse->getErrors() != null) {
                            $message_text = $tresponse->getErrors()[0]->getErrorText();
                            $msg_type = "error_msg";                                    
                        }
                        return response()->json(['msg'=>$message_text,'status' => 0]);
                    }
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";                                    
                    $tresponse = $response->getTransactionResponse();
                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";                    
                        return response()->json(['msg'=>$message_text,'status' => 0]);
                    } 
                    else 
                    {
                        $message_text = $response->getMessages()->getMessage()[0]->getText();
                        $msg_type = "error_msg";
                        return response()->json(['msg'=>$message_text,'status' => 0]);
                    }                
                }
            } 
            else 
            {
                $message_text = "No response returned";
                $msg_type = "error_msg";
                return response()->json(['msg'=>$message_text,'status' => 0]);
            }
            return response()->json(['msg'=>$message_text,'status' => 0]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function create_review(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'review' => 'required|max:500',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'rating' => 'required'
        ]);      
        if ($validator->passes()) {  
            $review = Review::create([
                'review' =>  $request['review'],
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'rating' => $request['rating'],
                'item_id' => $request['product_id'],
            ]);
            return response()->json(['msg' => 'Review Pending For Admin Approval!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
            
    }

    public function newsletterstore(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email|unique:newsletter,email|max:255',
        ],
        [
            'email.unique' => 'Sorry! You have already subscribed',
        ]);      
        
        if ($validator->passes()) {  
            $newsletter = Newsletter::create([
                'email' => $request['email'],
            ]);
            return redirect()->back()->withInput(['msg' => 'Thanks For Subscribe', 'status' => 1]);
            return response()->json(['msg' => 'Thanks For Subscribe', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
}
