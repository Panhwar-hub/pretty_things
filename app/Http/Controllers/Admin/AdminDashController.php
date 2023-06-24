<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Models\Crawls;
use App\Models\Keywords;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Brand;
use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\Mytickets;
use App\Models\Ticketchat;
use App\Models\User;
use App\Models\Admin;
use App\Models\Coupon;
use App\Models\Lesson;
use App\Models\Productvideos;
use App\Models\Partner;
use App\Models\Blog;
use App\Models\Vendor;
use App\Models\Ingredient;
use App\Models\Question;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Review;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Sub_category;
use App\Models\Newsletter;
use Auth;
use App\Models\Faq;
use App\Rules\PasswordMatch;
use Illuminate\Support\MessageBag;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class AdminDashController extends Controller
{
    public function __construct()
    {
         $logo = Imagetable::where('table_name','logo')->latest()->first();
         View()->share('logo',$logo);
         View()->share('config',$this->getConfig());
    }

    public function dashboard()
    {
        $arrays = array();
        for ($i=1; $i <=12 ; $i++) { 
            $total_amount = 0;
            $date = date('Y-'.$i.'-01');
            $yearordersrec = Orders::where('created_at','>=', $date) ->get();   
            foreach($yearordersrec as $key => $value){
                $total_amount += $value['total_amount'];
            }
            $arrays[] .= $total_amount;
        }
        $abc = implode(",",$arrays);
        $currentmonthorders = Orders::where('pay_status',1)->get()->count();
        $orderscount =Orders::where('pay_status',1)->get()->sum('total_amount');
        $users = User::get();

        $inquiry =  Inquiry::get();
        return view('admin.dashboard')->with('title','Admin Dashboard')->with('user_menu',true)->with(compact('users','orderscount','currentmonthorders','abc','inquiry'));
    }

    public function suspend_faq($id)
    {
        $faq = Faq::where('id',$id)->first();
        if($faq->is_active == 0)
        {
            $faq->is_active= 1;
            $faq->save();
            return redirect()->route('admin.faq_listing')->with('notify_success','Faq Activated Successfuly!!');
        }
        else{
            $faq->is_active= 0;
            $faq->save();
            return redirect()->route('admin.faq_listing')->with('notify_success','Faq Suspended Successfuly!!');
        }
    }

    public function delete_faq($id)
    {
        $faq = Faq::where('id',$id)->delete();
        return redirect()->route('admin.faq_listing')->with('notify_success','Faq Deleted Successfuly!!');
       
    }

    public function faq_listing()
    {
        $faq = Faq::latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.faq-management.list')->with('title','Faq Management')->with('faq_menu',true)->with(compact('faq'));
    }

    public function add_faq()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.faq-management.add')->with('title','Add Faq')->with('faq_menu',true);
    }

    public function create_faq(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            // 'type' => 'required',
        ]);  

        $faq = Faq::create([
            // 'faq_type_id' => $request['type'],
            'question' => $request['question'],
            'answer' => $request['answer'],
           
           
        ]);

       

          return redirect()->route('admin.faq_listing')->with('notify_success','Faq Created Successfuly!!');
    }

    public function edit_faq($id)
    {
        $faq = Faq::where('id',$id)->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.faq-management.edit')->with('title','Edit Faq')->with('faq_menu',true)->with(compact('faq'));
    }

    public function savefaq(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            // 'type' => 'required',
            // 'thumbnails' => 'required',
            // 'pictures'=> 'required',
        ]);  

        $faq = Faq::where('id',$request->id)->update([
            // 'faq_type_id' => $request['type'],
            'question' => $request['question'],
            'answer' => $request['answer'],
           
           
        ]);

          return redirect()->route('admin.faq_listing')->with('notify_success','Faq Updated Successfuly!!');
    }

    public function suspend_ingredient($id)
    {
        $faq = Ingredient::where('id',$id)->first();
        if($faq->is_active == 0)
        {
            $faq->is_active= 1;
            $faq->save();
            return redirect()->route('admin.ingredient_listing')->with('notify_success','Ingredient Activated Successfuly!!');
        }
        else{
            $faq->is_active= 0;
            $faq->save();
            return redirect()->route('admin.ingredient_listing')->with('notify_success','ingredient Suspended Successfuly!!');
        }
    }

    public function delete_ingredient($id)
    {
        $faq = Ingredient::where('id',$id)->delete();
        return redirect()->route('admin.ingredient_listing')->with('notify_success','Ingredient Deleted Successfuly!!');
       
    }

    public function ingredient_listing()
    {
        $faq = Ingredient::with('ingredientBelongsToProduct')->latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.ingredient-management.list')->with('title','Ingredient Management')->with('ingredient_menu',true)->with(compact('faq'));
    }

    public function add_ingredient()
    {
        $products = Products::where('is_active',1)->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.ingredient-management.add')->with('title','Add Ingredient')->with('ingredient_menu',true)->with(compact('products'));
    }

    public function create_ingredient(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'product' => 'required',
            'question' => 'required',
            'answer' => 'required',
            // 'type' => 'required',
        ]);  

        $faq = Ingredient::create([
            'product_id' => $request['product'],
            'question' => $request['question'],
            'answer' => $request['answer'],
           
           
        ]);

       

          return redirect()->route('admin.ingredient_listing')->with('notify_success','Ingredient Created Successfuly!!');
    }

    public function edit_ingredient($id)
    {
        $faq = Ingredient::where('id',$id)->first();
        $products = Products::where('is_active',1)->get();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.ingredient-management.edit')->with('title','Edit Ingredient')->with('ingredient_menu',true)->with(compact('faq','products'));
    }

    public function saveingredient(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'product' => 'required',
            'question' => 'required',
            'answer' => 'required',
            // 'type' => 'required',
            // 'thumbnails' => 'required',
            // 'pictures'=> 'required',
        ]);  

        $faq = ingredient::where('id',$request->id)->update([
            // 'faq_type_id' => $request['type'],
            'product_id'=>$request['product'],
            'question' => $request['question'],
            'answer' => $request['answer'],
           
           
        ]);

          return redirect()->route('admin.ingredient_listing')->with('notify_success','Ingredient Updated Successfuly!!');
    }

    public function suspend_question($id)
    {
        $faq = Question::where('id',$id)->first();
        if($faq->is_active == 0)
        {
            $faq->is_active= 1;
            $faq->save();
            return redirect()->route('admin.question_listing')->with('notify_success','Question Activated Successfuly!!');
        }
        else{
            $faq->is_active= 0;
            $faq->save();
            return redirect()->route('admin.question_listing')->with('notify_success','Question Suspended Successfuly!!');
        }
    }

    public function delete_question($id)
    {
        $faq = Question::where('id',$id)->delete();
        return redirect()->route('admin.question_listing')->with('notify_success','Question Deleted Successfuly!!');
       
    }

    public function question_listing()
    {
        $faq = Question::with('questionBelongsToProducts')->latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.question-management.list')->with('title','Question Management')->with('question_menu',true)->with(compact('faq'));
    }

    public function add_question()
    {
        $products = Products::where('is_active',1)->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.question-management.add')->with('title','Add Question')->with('question_menu',true)->with(compact('products'));
    }

    public function create_question(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'product' => 'required',
            'question' => 'required',
            'answer' => 'required',
            // 'type' => 'required',
        ]);  

        $faq = Ingredient::create([
            'product_id' => $request['product'],
            'question' => $request['question'],
            'answer' => $request['answer'],
           
           
        ]);

       

          return redirect()->route('admin.ingredient_listing')->with('notify_success','Ingredient Created Successfuly!!');
    }

    public function edit_question($id)
    {
        $faq = Question::where('id',$id)->with('questionBelongsToProducts')->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.question-management.edit')->with('title','Edit Question')->with('question_menu',true)->with(compact('faq'));
    }

    public function savequestion(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'is_active'=> 'required',
            // 'type' => 'required',
            // 'thumbnails' => 'required',
            // 'pictures'=> 'required',
        ]);  

        $faq = Question::where('id',$request->id)->update([
            // 'faq_type_id' => $request['type'],
            'item_id' => $request['product'],
            'is_answered'=> 1,
            'is_active'=> 1,
            'question' => $request['question'],
            'answer' => $request['answer'],
           
           
        ]);

          return redirect()->route('admin.question_listing')->with('notify_success','Question Updated Successfuly!!');
    }

    public function testimonial_listing()
    {
        $testimonial = Testimonial::get();
        return view('admin.testimonial-management.list')->with('title','Testimonial Management')->with('testimonial_menu',true)->with(compact('testimonial'));
    }

    public function add_testimonial()
    {
        return view('admin.testimonial-management.add')->with('title','Add Testimonial')->with('testimonial_menu',true);
    }

    public function create_testimonial(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|max:255',
            'thumbnails' => 'required',
            'description' => 'required'
            // 'slug' => 'required',
           
           
        ]);  

   
        $testimonial = Testimonial::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'designation' => $request['designation'],
            
           
        ]);

         if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/description/thumbnails/'.$testimonial->id.rand().rand(10,100), 'public');
           
            $image = Testimonial::where('id',$testimonial->id)->update(
             [

             'img_path' => $thumbnail,
         ]);
  
          }


       

          return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Created Successfuly!!');
    }

    public function edit_testimonial($id)
    {
        $testimonial = Testimonial::where('id',$id)->first();
        return view('admin.testimonial-management.edit')->with('title','Edit Testimonial')->with('testimonial_menu',true)->with(compact('testimonial'));
    }

    public function newsletter_listing()
    {
        $newsletter = Newsletter::get();
        return view('admin.newsletter.list')->with('title','Newsletter Listing')->with('newslettermenu',true)->with(compact('newsletter'));
    }

    public function newsletter_listing_delete($id)
    {
        $inquiry = Newsletter::where('id',$id)->delete();
        return back()->with('notify_success','Newsletter Deleted!');
    }

    public function savetestimonial(Request $request)
    {
    

        $request->validate([
            
            'name' => 'required|max:255',
            'description' => 'required'
        ]);  
        
   
        
        $testimonial = Testimonial::where('id',$request->id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'designation' => $request['designation'],

    
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/description/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Testimonial::where('id',$request->id)->update(
             [

             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Updated Successfuly!!');
    }

    public function suspend_testimonial($id)
    {
        $testimonial = Testimonial::where('id',$id)->first();
        if($testimonial->is_active == 0)
        {
            $testimonial->is_active= 1;
            $testimonial->save();
            return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Activated Successfuly!!');
        }
        else{
            $testimonial->is_active= 0;
            $testimonial->save();
            return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Suspended Successfuly!!');
        }
    }

    public function delete_testimonial($id)
    {
        $testimonial = Testimonial::where('id',$id)->delete();
        return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Deleted Successfuly!!');
       
    }

    public function reviews_listing()
    {
        $reviews = Review::with(['reviewBelongsToUser','reviewBelongsToProducts'])->get();
        return view('admin.reviews-management.list')->with('title','Reviews Management')->with('reviews_menu',true)->with(compact('reviews'));
    }

    // public function add_testimonial()
    // {
    //     return view('admin.testimonial-management.add')->with('title','Add Testimonial')->with('testimonial_menu',true);
    // }

    // public function create_testimonial(Request $request)
    // {
    //     // dd($request->all());

    //     $request->validate([
    //         'member_since' => 'required|numeric',
    //         'name' => 'required|max:255',
    //         'description' => 'required|max:500',
    //         // 'slug' => 'required',
           
           
    //     ]);  

    // //  $check_slug = Medicine::where('slug',$request->slug)->where('id','!=',$request->id)->first();
    // //     if($check_slug)
    // //     {
    // //         return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
    // //     }
    //    //dd($check_slug);
    //     $testimonial = Testimonial::create([
    //         'name' => $request['name'],
    //         'member_since' => $request['member_since'],
    //         'description' => $request['description'],
            
           
    //     ]);

    //     // if(request()->hasFile('thumbnails')){
    //     //     $thumbnail = request()->file('thumbnails')->store('Uploads/testimonial/thumbnails/'.$medicine->id.rand().rand(10,100), 'public');
    //     //     $image = Testimonial::where('id', $testimonial->id)->update (
    //     //      [
    //     //      'image' => $thumbnail,
    //     //  ]);
    //     //   }

    //       return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Created Successfuly!!');
    // }

    // public function edit_reviews($id)
    // {
    //     $reviews = Review::where('id',$id)->first();
    //     return view('admin.reviews-management.edit')->with('title','Edit Reviews')->with('reviews_menu',true)->with(compact('reviews'));
    // }

    // public function savereviews(Request $request)
    // {
    // //    dd($request->all());

    //     $request->validate([
    //         'member_since' => 'required|numeric',
    //         'name' => 'required|max:255',
    //         'description' => 'required|max:500',
          
            
            
            
    //     ]);  
        
    //     //  $check_slug = Medicine::where('slug',$request->slug)->where('id','!=',$request->id)->first();
    //     // if($check_slug)
    //     // {
    //     //     return back()->with('notify_error','Unique Slug Is Required!'); 
    //     // }
    //     //dd($check_slug);
        
    //     $testimonial = Review::where('id',$request->id)->update([
    //         'name' => $request['name'],
    //         'member_since' => $request['member_since'],
    //         'description' => $request['description'],
    //     ]);

    //     // if(request()->hasFile('thumbnails')){
    //     //     $thumbnail = request()->file('thumbnails')->store('Uploads/description/thumbnails/'.$request->id.rand().rand(10,100), 'public');
    //     //     $image = Testimonial::where('id',$request->id)->update(
    //     //      [

    //     //      'image' => $thumbnail,
    //     //  ]);
    //     //   }

    //       return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Updated Successfuly!!');
    // }

    
    public function suspend_reviews($id)
    {
        $reviews = Review::where('id',$id)->first();
        if($reviews->is_active == 0)
        {
            $reviews->is_active= 1;
            $reviews->save();
            return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Activated Successfuly!!');
        }
        else{
            $reviews->is_active= 0;
            $reviews->save();
            return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Suspended Successfuly!!');
        }
    }

    public function delete_reviews($id)
    {
        $reviews = Review::where('id',$id)->delete();
        return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Deleted Successfuly!!');
       
    }

    public function blog_listing()
    {
        $blog = Blog::get();
        return view('admin.blog-management.list')->with('title','Blog Management')->with('blog_menu',true)->with(compact('blog'));
    }

    public function add_blog()
    {
        return view('admin.blog-management.add')->with('title','Add Blog')->with('blog_menu',true);
    }

    public function create_blog(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
        ]);  

     $check_slug = Blog::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
       //dd($check_slug);
        $blog = Blog::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
            
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$blog->id.rand().rand(10,100), 'public');
            $image = Blog::where('id', $blog->id)->update (
             [
             'blog_img' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.blog_listing')->with('notify_success','Blog Created Successfuly!!');
    }

    public function edit_blog($id)
    {
        $blog = Blog::where('id',$id)->first();
        return view('admin.blog-management.edit')->with('title','Edit Blog')->with('blog_menu',true)->with(compact('blog'));
    }

    public function saveblog(Request $request)
    {
    
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            
            
        ]);  
        
         $check_slug = Blog::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }
        //dd($check_slug);
        
        $blog = Blog::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Blog::where('id',$request->id)->update(
             [

             'blog_img' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.blog_listing')->with('notify_success','Blog Updated Successfuly!!');
    }

    
    public function suspend_blog($id)
    {
        $blog = Blog::where('id',$id)->first();
        if($blog->is_active == 0)
        {
            $blog->is_active= 1;
            $blog->save();
            return redirect()->route('admin.blog_listing')->with('notify_success','Blog Activated Successfuly!!');
        }
        else{
            $blog->is_active= 0;
            $blog->save();
            return redirect()->route('admin.blog_listing')->with('notify_success','Blog Suspended Successfuly!!');
        }
    }

    public function delete_blog($id)
    {
        $blog = Blog::where('id',$id)->delete();
        return redirect()->route('admin.blog_listing')->with('notify_success','Blog  Deleted Successfuly!!');
       
    }

    public function news_events_listing()
    {
        $news = News::get();
        return view('admin.news-management.list')->with('title','News Events Management')->with('news_menu',true)->with(compact('news'));
    }

    public function add_news_events()
    {
        return view('admin.news-management.add')->with('title','Add News Events')->with('news_menu',true);
    }

    public function create_news_events(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'date' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
        ]);  

     $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
       //dd($check_slug);
        $news = News::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'date' => $request['date'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
            
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$news->id.rand().rand(10,100), 'public');
            $image = News::where('id', $news->id)->update (
             [
             'news_img' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.news_events_listing')->with('notify_success','News Created Successfuly!!');
    }

    public function edit_news_events($id)
    {
        $news = News::where('id',$id)->first();
        return view('admin.news-management.edit')->with('title','Edit News Events')->with(' news_menu',true)->with(compact('news'));
    }

    public function savenews_events(Request $request)
    {
    

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'date' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            
            
        ]);  
        
         $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }
        //dd($check_slug);
        
        $news = News::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'date' => $request['date'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = News::where('id',$request->id)->update(
             [

             'news_img' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.news_events_listing')->with('notify_success','News Updated Successfuly!!');
    }

    public function suspend_news_events($id)
    {
        $news = News::where('id',$id)->first();
        if($news->is_active == 0)
        {
            $news->is_active= 1;
            $news->save();
            return redirect()->route('admin.news_events_listing')->with('notify_success','News Activated Successfuly!!');
        }
        else{
            $news->is_active= 0;
            $news->save();
            return redirect()->route('admin.news_events_listing')->with('notify_success','News Suspended Successfuly!!');
        }
    }

    public function delete_news_events($id)
    {
        $news = News::where('id',$id)->delete();
        return redirect()->route('admin.news_events_listing')->with('notify_success','News  Deleted Successfuly!!');
       
    }

    public function check_slug(Request $request)
    {
        $slug = Str::slug($request->title,'-');
        return response()->json(['slug' => $slug]);
    }

    public function NewWebCrawl()
    {
        return view('admin.newwebcrawl')->with('title','New Web Crawl')->with('web_crawl',true);
    }
    
    public function ListWebCrawl()
    {
        $all_crawls = Keywords::where('is_active',1)->with('keywordHasCrawls')->latest()->get();
       // dd($all_crawls);
         return view('admin.webcrawl-listing')->with('title','List Web Crawls')->with('web_crawl',true)->with(compact('all_crawls'));
    }
    
    public function crawlDetail($id)
    {
        $main_cat = Category::where('is_active',1)->get();
        $sub_cat = Sub_category::where('is_active',1)->get();
        $crawlDetail = Keywords::where('id',$id)->with('keywordHasCrawls')->first();
        if($crawlDetail)
        {
              return view('admin.crawl-detail')->with('title','Web Crawls Details')->with('web_crawl',true)->with(compact('crawlDetail','main_cat','sub_cat'));
        }
        else
        {
            return back()->with('notify_error','No Data Availible!');   
        }
       
      
    }
    
    public function crawlEdit($id)
    {
        $crawlDetail = Crawls::where('id',$id)->first();
       // dd($crawlDetail);
        return view('admin.edit-crawl')->with('title','Web Crawls Edit')->with('web_crawl',true)->with(compact('crawlDetail'));
    }
    
    public function crawlUpdate(Request $request)
    {
        $crawlUpdate = Crawls::where('id',$request->id)->update([
            'result_title'=> $request['result_title'],
            'result_url'=> $request['result_url'],
            ]);
            $crawl =  Crawls::where('id',$request->id)->first();
            $keyword = Keywords::where('id',$crawl->keyword_id)->first();
        //   dd($keyword);
            
            return redirect()->route('admin.crawlDetail',$keyword->id)->with('notify_success','Crawl Updated!');
        //return view('admin.crawl-detail')->with('title','Web Crawls Details')->with('web_crawl',true)->with(compact('crawlDetail'));
    }
    
    public function crawlDelete($id)
    {
        //dd($id);
        $keywords_delete = Keywords::where('id',$id)->delete();
        $crawl_delete = Crawls::where('keyword_id',$id)->delete();
        return back()->with('notify_success','Crawl Deleted Successfuly!')->with('crawl_success',true)->with('popup_message','Crawl Deleted Successfuly!');
    }
    
    public function crawlStatusUpdate(Request $request)
    {
        
        //dd($request->all());
        $keyword_id = $request['keyword_id'];
       
        foreach($request['link_id'] as $link)
        {
          // $link = (int)$link;
         // dd($request['is_published-'.$link]);
        //  dd($request->has('is_published-'.$link));
            if($request->has('is_published-'.$link))
            {
            
                     $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                    'is_published' => $request['is_published-'.$link]
                    ]);
                    
                   // dd($update_status);
            }
          
            if($request->has('is_archived-'.$link))
            {
                $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                        'is_archived' => $request['is_archived-'.$link]
                        ]);
            }
          
            if($request->has('main_category-'.$link))
            {
                $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                        'main_category_id' => $request['main_category-'.$link]
                        ]);
            }
            if($request->has('sub_category-'.$link))
            {
                $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                        'sub_category_id' => $request['sub_category-'.$link]
                        ]);
            }
          
      }
      
      return redirect()->route('admin.crawlDetail',$keyword_id)->with('notify_success','Crawl Status Updated Successfully!');
      
      
      
        // if($request['is_published'])
        // {
        //      $update_status =  Crawls::where('keyword_id',$keyword_id)->update([
        //             'is_published' => '0'
        //             ]);
        //     foreach($request['is_published'] as $k)
        //     {
        //         $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$k)->update([
        //             'is_published' => '1'
        //             ]);
                    
        //     }
            
        // }
        // if($request['is_archived'])
        // {
        //      $update_status =  Crawls::where('keyword_id',$keyword_id)->update([
        //             'is_archived' => '0'
        //             ]);
        //     foreach($request['is_archived'] as $k)
        //     {
        //         $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$k)->update([
        //             'is_archived' => '1'
        //             ]);
                    
        //     }
        // }
        // $param['status'] = 1;
        // echo json_encode($param);
        // //dd($id);
       

    }

    public function searchCrawl(Request $request)
    {
        //  dd($request->all());
            if($request['domain_name'] == 1)
            {
                $request['domain'] = "www.google.com";
            }
            else if($request['domain_name'] == 2)
            {
                $request['domain'] = "www.bing.com";
            }
            else if($request['domain_name'] == 3)
            {
                $request['domain'] = "www.yahoo.com";
            }
            // $i = 1;
            // while($i <= 100)
            // {
           // dd($request->all());
            $curl = curl_init();
           
            curl_setopt_array($curl, array(
          
            CURLOPT_URL => 'https://api.proxycrawl.com/scraper?token=7x4WyHfeqchHH4mz0BKVDw&url=https%3A%2F%2Fwww.google.com%2Fsearch%3Fq%3D'.str_replace('%2B+','%2B',str_replace(',','%2B',str_replace(' ','+',$request->keywords))).'%26num%3D100'
            ,CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 50,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            //  echo 
            // exit;
            $response = curl_exec($curl);
            // dd();
            // echo "<pre>";
            // print_r($response);
            // exit;
            curl_close($curl);
             $response = json_decode($response);
           //  dd($response);
             if(!empty($response))
             {
                // dd($response->body->searchResults);
                $create_keyword = Keywords::create([
                    'keywords' => $request->keywords,
                    ]);
                 foreach($response->body->searchResults as $key => $value)
                 {
                     $find_crawl = Crawls::where('result_url',$value->url)->get();
                     //dd($find_crawl);
                     if(!empty($find_crawl->items))
                     {
                        continue; 
                     }
                     else
                     {
                         $create_crawl = Crawls::create([
                             'keyword_id' => $create_keyword->id,
                             'domain_name' => $request['domain'],
                             'position' => $value->position,
                             'result_title' => mb_strtolower($value->title),
                             'result_url' => $value->url,
                             'result_destination' => $value->destination,
                             'result_description' => $value->description,
                             ]);
                     }
                     //dd($value);
                 }
                //   return back()->with('notify_success','Crawl Ran Successfuly!')->with('crawl_success',true)->with('popup_message','Crawl Ran Successfuly!');
                    return response()->json(['msg' => 'Crawl Ran Successfuly!', 'status' => 1]);
                 //return 
             }
             else
             {
                //  return back()->with('notify_error','Something went wrong, please try again!');
                return response()->json(['msg' => 'Something went wrong, please try again!', 'status' => 0]);
                 
                 
             }
            //dd($response->original_status == 200);
            // echo "<pre>";
            // print_r(json_decode($response));
        // $i++;
                
            // }
    }

    public function inquiries_listing()
    {
        $inquiries = Inquiry::get();
        return view('admin.inquiries.list')->with('title','Inquiries')->with('inquiry_menu',true)->with(compact('inquiries'));
    }

    public function inquiries_listing_view($id)
    {
        $inquiry = Inquiry::where('id',$id)->first();
        if($inquiry)
        {
            $is_read = Inquiry::where('id',$id)->update([
                'is_read' => 1
            ]);
        }
      
        return view('admin.inquiries.view')->with('title','View Inquiry')->with('inquiry_menu',true)->with(compact('inquiry'));
    }

    public function inquiries_listing_delete($id)
    {
        $inquiry = Inquiry::where('id',$id)->delete();
        return back()->with('notify_success','Inquiry Deleted!');
    }

    public function users_listing()
    {
        $users = User::get();
        return view('admin.users-management.list')->with('title','User Management')->with('user_mgmmenu',true)->with(compact('users'));
    }

    public function add_users()
    {
        $users = User::get();
        return view('admin.users-management.add')->with('title','Add New User')->with('user_mgmmenu',true)->with(compact('users'));
    }

    public function create_users(Request $request)
    {
      
        $validator = Validator::make($request->all(),[
            'fullname' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|same:password|max:255',
            'email' => 'required|unique:users|max:255',
            'is_active' => 'required',
        ]);
        
        if ($validator->passes()) {  
            $user = User::create([
                'fullname' => $request['fullname'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'is_active' => $request['is_active'],
            ]);

            if(request()->hasFile('avatar')){
                $avatar = request()->file('avatar')->store('Uploads/avatar/'.$user->id.rand().rand(10,100), 'public');
                $image = User::where('id',$user->id)->update (
                [
                    'img_path' => $avatar,
                ]);
            }
           return response()->json(['msg' => 'User Added Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
        
    }

    public function edit_user($id)
    {
        $user = User::where('id',$id)->with('img_tab')->first();
        if($user)
        {
            return view('admin.users-management.edit')->with('title','Edit User')->with('user_mgmmenu',true)->with(compact('user'));
        }
        else{
            return back()->with('notify_error','User Not Found!');
        }
    }

    public function saveprofile(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'is_active'=> 'required'
        ]);  

        $user = User::where('id',$request->id)->where('email',$request->email)->with('img_tab')->first(); 
        $user->fullname= $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->is_active = $request->is_active;
        $user->save(); 

        if(request()->hasFile('avatar')){
            $avatar = request()->file('avatar')->store('Uploads/avatar/'.$request->id.rand().rand(10,100), 'public');
            $image = User::where('id',$request->id)->update (
            [
                'img_path' => $avatar,
            ]);
        }
        return redirect()->route('admin.users_listing')->with('notify_success','User Updated Successfuly!!');
    }

    public function suspend_user($id)
    {
        $user = User::where('id',$id)->first();
        if($user->is_active == 0)
        {
            $user->is_active= 1;
            $user->save();
            return redirect()->route('admin.users_listing')->with('notify_success','User Activated Successfuly!!');
        }
        else{
            $user->is_active= 0;
            $user->save();
            return redirect()->route('admin.users_listing')->with('notify_success','User Suspended Successfuly!!');
        }
 

    }

    public function suspend_news($id)
    {
        $news = News::where('id',$id)->first();
        if($news->is_active == 0)
        {
            $news->is_active= 1;
            $news->save();
            return redirect()->route('admin.news_listing')->with('notify_success','News Activated Successfuly!!');
        }
        else{
            $news->is_active= 0;
            $news->save();
            return redirect()->route('admin.news_listing')->with('notify_success','News Suspended Successfuly!!');
        }
    }

    public function delete_news($id)
    {
        $news = News::where('id',$id)->delete();
        return redirect()->route('admin.news_listing')->with('notify_success','News Deleted Successfuly!!');
       
    }

    public function news_listing()
    {
        $news = News::get();
        return view('admin.news-management.list')->with('title','News Management')->with('news_menu',true)->with(compact('news'));
    }

    public function add_news()
    {
        return view('admin.news-management.add')->with('title','Add News')->with('news_menu',true);
    }

    public function create_news(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
            'pictures'=> 'required',
        ]);  

     $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
       //dd($check_slug);
        $news = News::create([
            'title' => $request['name'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/thumbnails/'.$news->id.rand().rand(10,100), 'public');
            $image = imagetable::create (
             [
             'table_name' => 'news-thumbnail',
             'img_path' => $thumbnail,
             'ref_id' => $news->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          if(request()->hasFile('pictures')){
            $picture = request()->file('pictures')->store('Uploads/pictures/'.$news->id.rand().rand(10,100), 'public');
            $image = imagetable::create (
             [
             'table_name' => 'news-picture',
             'img_path' => $picture,
             'ref_id' => $news->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          return redirect()->route('admin.news_listing')->with('notify_success','News Created Successfuly!!');
    }

    public function edit_news($id)
    {
        $news = News::where('id',$id)->with('thumbnail','picture')->first();
        return view('admin.news-management.edit')->with('title','Edit News')->with('news_menu',true)->with(compact('news'));
    }

    public function savenews(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ]);  
        
         $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }
        
        $news = News::where('id',$request->id)->update([
            'title' => $request['name'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = imagetable::updateOrCreate (
                [
                 'ref_id' => $request->id,
                 'table_name' => 'news-thumbnail',
                ],
             [
             'table_name' => 'news-thumbnail',
             'img_path' => $thumbnail,
             'ref_id' => $request->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          if(request()->hasFile('pictures')){
            $picture = request()->file('pictures')->store('Uploads/pictures/'.$request->id.rand().rand(10,100), 'public');
            $image = imagetable::updateOrCreate  (
                [
                 'ref_id' => $request->id,
                 'table_name' => 'news-picture',
                ],
             [
             'table_name' => 'news-picture',
             'img_path' => $picture,
             'ref_id' => $request->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          return redirect()->route('admin.news_listing')->with('notify_success','News Updated Successfuly!!');
    }
    
    public function admins_listing()
    {
        $admins = Admin::get();
        return view('admin.admin-management.list')->with('title','Admin Management')->with('admin_mgmmenu',true)->with(compact('admins'));
    }

    public function add_admins()
    {
        $admins = Admin::get();
        return view('admin.admin-management.add')->with('title','Add New Admin')->with('admin_mgmmenu',true)->with(compact('admins'));
    }

    public function create_admin(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|same:password|max:255',
            'email' => 'required|unique:admin|max:255',
            'is_active' => 'required',
            'type' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'is_active' => $request['is_active'],
        ]);

        return redirect()->route('admin.admin_listing')->with('notify_success','Admin Created Successfuly!!');
    }

    public function edit_admin($id)
    {
        $admin = Admin::where('id',$id)->first();
        if($admin)
        {
            return view('admin.admin-management.edit')->with('title','Edit Admin')->with('admin_mgmmenu',true)->with(compact('admin'));
        }
        else{
            return back()->with('notify_error','Admin Not Found!');
        }
    }
    
    public function saveadmin(Request $request)
    {
        $admin = Admin::where('id',$request->id)->where('email',$request->email)->first(); 
        if($admin->type == 1)
        {
            $request->validate([
                'name' => 'required|max:255',
            ]);  

            $admin = Admin::where('id',$request->id)->where('email',$request->email)->first(); 
            $admin->name= $request->name;
            if($request['password'])
            {
                $admin->password = bcrypt($request->password);
            }
            $admin->save(); 
        }
        else
        {
            $request->validate([
                'name' => 'required|max:255',
            
                'type' => 'required',
                'is_active' => 'required'
            ]);  

            $admin = Admin::where('id',$request->id)->where('email',$request->email)->first(); 
            $admin->name= $request->name;
            $admin->type = $request->type;
        
            $admin->is_active = $request->is_active;
            if($request['password'])
            {
                $admin->password = bcrypt($request->password);
            }
            $admin->save(); 
        }
        return redirect()->route('admin.admin_listing')->with('notify_success','Admin Updated Successfuly!!');
    }
    
    public function suspend_admin($id)
    {
        $admin = Admin::where('id',$id)->first();
        if($admin->is_active == 0)
        {
            $admin->is_active= 1;
            $admin->save();
            return redirect()->route('admin.admin_listing')->with('notify_success','Admin Activated Successfuly!!');
        }
        else{
            $admin->is_active= 0;
            $admin->save();
            return redirect()->route('admin.admin_listing')->with('notify_success','Admin Suspended Successfuly!!');
        }
 

    }

    public function subcategory_listing()
    {
        $subcategory = Sub_category::with('category')->get();
        return view('admin.subcategory-management.list')->with('title','Sub Category Management')->with('subcategory_menu',true)->with(compact('subcategory'));
    }

    public function add_subcategory()
    {
        $maincategory = Category::where('is_active',1)->get();
        return view('admin.subcategory-management.add')->with('title','Sub Category')->with('subcategory_menu',true)->with(compact('maincategory'));
    }

    public function create_subcategory(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
        ]
        ,[
            'category_id.required' => 'The category field is required.'
        ]);  
 
        $subcategory = Sub_category::create([
            'title' => $request['title'],
            'category_id' => $request['category_id'],
        ]);

        return redirect()->route('admin.subcategory_listing')->with('notify_success','SubCategory Created Successfuly!!');
    }

    public function edit_subcategory($id)
    {

        $subcategory = Sub_Category::where('id',$id)->with('category')->first();
        $maincategory = Category::where('is_active',1)->with('sub_categories')->get();
        return view('admin.subcategory-management.edit')->with('title','Edit sub category')->with('subcategory_menu',true)->with(compact('subcategory','maincategory'));
    }

    public function savesubcategory(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
        ]
        ,[
            'category_id.required' => 'The category field is required.'
        ]); 
                
        $subcategory = Sub_category::where('id',$request->id)->update([
            'title' => $request['title'],
            'category_id' => $request['category_id'],
        ]);
        return redirect()->route('admin.subcategory_listing')->with('notify_success','Sub Category Updated Successfuly!!');
    }
    
    public function suspend_subcategory($id)
    {
        $subcategory = Sub_category::where('id',$id)->first();
        if($subcategory->is_active == 0)
        {
            $subcategory->is_active= 1;
            $subcategory->save();
            return redirect()->route('admin.subcategory_listing')->with('notify_success',' Sub Category Activated Successfuly!!');
        }
        else{
            $subcategory->is_active= 0;
            $subcategory->save();
            return redirect()->route('admin.subcategory_listing')->with('notify_success','Sub Category Suspended Successfuly!!');
        }
    }

    public function delete_subcategory($id)
    {
        $subcategory = Sub_category::where('id',$id)->delete();
        return redirect()->route('admin.subcategory_listing')->with('notify_success','Sub Category Deleted Successfuly!!');
       
    }

    public function category_listing()
    {
        $category = Category::get();
        return view('admin.category-management.list')->with('title','Category Management')->with('category_menu',true)->with(compact('category'));
    }

    public function add_category()
    {
        return view('admin.category-management.add')->with('title','Category News')->with('category_menu',true);
    }
    
    public function savecategory(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
        ]);  
                
        $category = Category::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/category/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Category::where('id', $request->id)->update (
            [
                'img_path' => $thumbnail,
            ]);
        }
        return redirect()->route('admin.category_listing')->with('notify_success','Category Updated Successfuly!!');
    }

    public function create_category(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:category',
            'thumbnails' => 'required|mimes:jpeg,jpg,png,webp',
        ]);  
        
        $category = Category::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
        ]);
        // dd($request);
        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/category/thumbnails/'.$category->id.rand().rand(10,100), 'public');
            $image = Category::where('id', $category->id)->update (
            [
                'img_path' => $thumbnail,
            ]);
        }

        return redirect()->route('admin.category_listing')->with('notify_success','Category Created Successfuly!!');
    }

    public function edit_category($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category-management.edit')->with('title','Edit category')->with('category_menu',true)->with(compact('category'));
    }
    
    public function suspend_category($id)
    {
        $category = category::where('id',$id)->first();
        if($category->is_active == 0)
        {
            $category->is_active= 1;
            $category->save();
            return redirect()->route('admin.category_listing')->with('notify_success','Category Activated Successfuly!!');
        }
        else{
            $category->is_active= 0;
            $category->save();
            return redirect()->route('admin.category_listing')->with('notify_success','Category Suspended Successfuly!!');
        }
    }

    public function delete_category($id)
    {
        $category = Category::where('id',$id)->delete();
        return redirect()->route('admin.category_listing')->with('notify_success','Category Deleted Successfuly!!');
    }

    public function lesson_listing()
    {
        $lesson = Lesson::get();
        return view('admin.lesson-management.list')->with('title','News Management')->with('lesson_menu',true)->with(compact('lesson'));
    }

    public function add_lesson()
    {
        return view('admin.lesson-management.add')->with('title','Add News')->with('lesson_menu',true);
    }

    public function create_lesson(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
        ]);  

        $check_slug = Lesson::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
        $lesson = Lesson::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/lesson/thumbnails/'.$lesson->id.rand().rand(10,100), 'public');
            $image = Lesson::where('id', $lesson->id)->update (
             [
             'img_path' => $thumbnail,
         ]);
        }

        return redirect()->route('admin.lesson_listing')->with('notify_success','News Created Successfuly!!');
    }

    public function edit_lesson($id)
    {
        $lesson = Lesson::where('id',$id)->first();
        return view('admin.lesson-management.edit')->with('title','Lesson News')->with('lesson_menu',true)->with(compact('lesson'));
    }

    public function savelesson(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ]);  
        
         $check_slug = Lesson::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }
        
        $lesson = Lesson::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/lesson/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Lesson::updateOrCreate (
                [
                 'id' => $request->id,
                ],
             [

             'img_path' => $thumbnail,
         ]);
        }

        return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson Updated Successfuly!!');
    }

    public function suspend_lesson($id)
    {
        $lesson = Lesson::where('id',$id)->first();
        if($lesson->is_active == 0)
        {
            $lesson->is_active= 1;
            $lesson->save();
            return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson Activated Successfuly!!');
        }
        else{
            $lesson->is_active= 0;
            $lesson->save();
            return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson Suspended Successfuly!!');
        }
    }

    public function delete_lesson($id)
    {
        $lesson = Lesson::where('id',$id)->delete();
        return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson  Deleted Successfuly!!');
    }

    public function partner_listing()
    {
        $partner = Partner::get();
        return view('admin.partner-management.list')->with('title','Partner Management')->with('partner_menu',true)->with(compact('partner'));
    }

    public function add_partner()
    {
        return view('admin.partner-management.add')->with('title','Add partner')->with('partner_menu',true);
    }

    public function create_partner(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'thumbnails' => 'required',
        ]);  
      
        $partner = Partner::create([
            'title' => $request['title'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/partner/thumbnails/'.$partner->id.rand().rand(10,100), 'public');
            $image = Partner::where('id', $partner->id)->update (
             [
             'img_path' => $thumbnail,
         ]);
        }

        return redirect()->route('admin.partner_listing')->with('notify_success','Partner Created Successfuly!!');
    }

    public function getsubcategory(Request $request)
    {
        $subcategory = Sub_category::where('is_active',1)->where('category_id',$request->category_id)->select('id','title')->get()->toArray();
        if(!empty($subcategory))
        {
            return response()->json( ['status' => 1 , 'data'=>$subcategory]);
        }
        else{
            return response()->json( ['status' => 0 ]);
        }
    }

    public function edit_partner($id)
    {
        $partner = Partner::where('id',$id)->first();
        return view('admin.partner-management.edit')->with('title','Edit partner')->with('partner_menu',true)->with(compact('partner'));
    }

    public function savepartner(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);  
  
        $partner = Partner::where('id',$request->id)->update([
            'title' => $request['title'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/partner/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Partner::where('id',$request->id)->update (
            [
                'img_path' => $thumbnail,
            ]);
        }
        return redirect()->route('admin.partner_listing')->with('notify_success','Partner Updated Successfuly!!');
    }

    public function suspend_partner($id)
    {
        $partner = Partner::where('id',$id)->first();
        if($partner->is_active == 0)
        {
            $partner->is_active= 1;
            $partner->save();
            return redirect()->route('admin.partner_listing')->with('notify_success','Partner Activated Successfuly!!');
        }
        else{
            $partner->is_active= 0;
            $partner->save();
            return redirect()->route('admin.partner_listing')->with('notify_success','Partner Suspended Successfuly!!');
        }
    }

    public function delete_partner($id)
    {
        $partner = Partner::where('id',$id)->delete();
        return redirect()->route('admin.partner_listing')->with('notify_success','Partner  Deleted Successfuly!!');
    }

    public function vendor_listing()
    {
        $vendor = Vendor::get();
        return view('admin.vendor-management.list')->with('title','Vendor Management')->with('vendor_menu',true)->with(compact('vendor'));
    }

    public function add_vendor()
    {
        return view('admin.vendor-management.add')->with('title','Add Vendor')->with('vendor_menu',true);
    }
    
    public function savevendor(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);  
                
        $vendor = Vendor::where('id',$request->id)->update([
            'title' => $request['title'],
        ]);

        if(request()->hasFile('vendor_image')){
            $validator = Validator::make($request->all(),[
                'vendor_image' => 'required|mimes:jpeg,jpg,png',
            ]);      
            $main_image = request()->file('vendor_image')->store('Uploads/vendor_image/'.$request->id.rand().rand(10,100), 'public');
            $image = Vendor::where('id',$request->id)->update(
                [
                'img_path' => $main_image,
            ]);
        }
        return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Updated Successfuly!!');
    }

    public function create_vendor(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:vendor',
            'vendor_image' => 'required|mimes:jpeg,jpg,png',
        ]);  
 
        $vendor = Vendor::create([
            'title' => $request['title']]);

        if(request()->hasFile('vendor_image')){
            $main_image = request()->file('vendor_image')->store('Uploads/vendor_image/'.$vendor->id.rand().rand(10,100), 'public');
            $image = Vendor::where('id',$vendor->id)->update(
                [
                'img_path' => $main_image,
            ]);
        }
        return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Created Successfuly!!');
    }

    public function edit_vendor($id)
    {

        $vendor = Vendor::where('id',$id)->first();
        return view('admin.vendor-management.edit')->with('title','Edit Vendor')->with('vendor_menu',true)->with(compact('vendor'));
    }
    
    public function suspend_vendor($id)
    {
        $vendor = Vendor::where('id',$id)->first();
        if($vendor->is_active == 0)
        {
            $vendor->is_active= 1;
            $vendor->save();
            return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Activated Successfuly!!');
        }
        else{
            $vendor->is_active= 0;
            $vendor->save();
            return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Suspended Successfuly!!');
        }
    }

    public function delete_vendor($id)
    {
        $vendor = Vendor::where('id',$id)->delete();
        return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Deleted Successfuly!!');
       
    }

    public function brand_listing()
    {
        $brand = Brand::get();
        return view('admin.brand-management.list')->with('title','Brand Management')->with('brand_menu',true)->with(compact('brand'));
    }

    public function add_brand()
    {
        return view('admin.brand-management.add')->with('title','Add Brand')->with('brand_menu',true);
    }
    
    public function savebrand(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
        ]);  
        $brand = Brand::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'], 
        ]);

        return redirect()->route('admin.brand_listing')->with('notify_success','Category Updated Successfuly!!');
    }

    public function create_brand(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:brand',            
        ]);  
 
        $brand = Brand::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
         ]);
         
        return redirect()->route('admin.brand_listing')->with('notify_success','Brand Created Successfuly!!');
    }

    public function edit_brand($id)
    {

        $brand = Brand::where('id',$id)->first();
        return view('admin.brand-management.edit')->with('title','Edit Brand')->with('brand_menu',true)->with(compact('brand'));
    }
    
    public function suspend_brand($id)
    {
        $brand = Brand::where('id',$id)->first();
        if($brand->is_active == 0)
        {
            $brand->is_active= 1;
            $brand->save();
            return redirect()->route('admin.brand_listing')->with('notify_success','Brand Activated Successfuly!!');
        }
        else{
            $brand->is_active= 0;
            $brand->save();
            return redirect()->route('admin.brand_listing')->with('notify_success','Brand Suspended Successfuly!!');
        }
    }

    public function delete_brand($id)
    {
        $category = Brand::where('id',$id)->delete();
        return redirect()->route('admin.brand_listing')->with('notify_success','Brand Deleted Successfuly!!');
       
    }

    public function videomanagement_listing()
    {
        $video = Productvideos::get();
        return view('admin.videos-management.list')->with('title','Video Management')->with('videomanagement_menu',true)->with(compact('video'));
    }

    public function add_videomanagement()
    {
        return view('admin.videos-management.add')->with('title','Add Video')->with('videomanagement_menu',true);
    }

    public function create_videomanagement(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'title' => 'required',
        ]);  

        $video = Productvideos::create([
            'video_link' => $request['link'],
            'title' => $request['title'],
        ]);

          return redirect()->route('admin.videomanagement_listing')->with('notify_success','Video Created Successfuly!!');
    }

    public function edit_videomanagement($id)
    {
        $video = Productvideos::where('id',$id)->first();
        return view('admin.videos-management.edit')->with('title','Edit Video')->with('videomanagement_menu',true)->with(compact('video'));
    }

    public function savevideomanagemen(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'link' => 'required',
        ]);  
        
        $video = Productvideos::where('id',$request->id)->update([
            'video_link' => $request['link'],
            'title' => $request['title'],
        ]);

          return redirect()->route('admin.videomanagement_listing')->with('notify_success','Video Updated Successfuly!!');
    }

    public function suspend_videomanagement($id)
    {
       $video = Productvideos::where('id',$id)->first();
        if($video->is_active == 0)
        {
           $video->is_active= 1;
           $video->save();
            return redirect()->route('admin.videomanagement_listing')->with('notify_success','Video Activated Successfuly!!');
        }
        else{
           $video->is_active= 0;
           $video->save();
            return redirect()->route('admin.videomanagement_listing')->with('notify_success','Video Suspended Successfuly!!');
        }
    }

    public function delete_videomanagement($id)
    {
        $video = Productvideos::where('id',$id)->delete();
        return redirect()->route('admin.videomanagement_listing')->with('notify_success','Video  Deleted Successfuly!!');
       
    }

    public function coupon_listing()
    {
        $coupon= Coupon::latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.coupon-management.list')->with('title','Coupon Management')->with('coupon_menu',true)->with(compact('coupon'));
    }

    public function add_coupon()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.coupon-management.add')->with('title','Add Coupon')->with('coupon_menu',true);
    }

    public function create_coupon(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'coupon_code' => 'required',
            'coupon_price' => 'required|numeric',
        ]);  

        $coupon = Coupon::create([
            'title' => $request['title'],
            'coupon_code' => $request['coupon_code'],
            'coupon_price' => $request['coupon_price'],
        ]);
        return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Created Successfuly!!');
    }

    public function edit_coupon($id)
    {
        $coupon = Coupon::where('id',$id)->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.coupon-management.edit')->with('title','Edit Coupon')->with('coupon_menu',true)->with(compact('coupon'));
    }

    public function savecoupon(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'coupon_code' => 'required',
            'coupon_price' => 'required|numeric',
        ]); 

        $coupon = Coupon::where('id',$request->id)->update([
            'title' => $request['title'],
            'coupon_code' => $request['coupon_code'],
            'coupon_price' => $request['coupon_price'],
        ]);

          return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Updated Successfuly!!');
    }

    public function suspend_coupon($id)
    {
        $coupon =Coupon::where('id',$id)->first();
        if($coupon->is_active == 0)
        {
            $coupon->is_active= 1;
            $coupon->save();
            return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Activated Successfuly!!');
        }
        else{
            $coupon->is_active= 0;
            $coupon->save();
            return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Suspended Successfuly!!');
        }
    }

    public function delete_coupon($id)
    {
        $coupon = Coupon::where('id',$id)->delete();
        return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Deleted Successfuly!!');
       
    }

    public function ticket_listing()
    {
        $myticket = Mytickets::get();
        return view('admin.ticket-management.list')->with('title','Ticket Management')->with('ticket_menu',true)->with(compact('myticket'));
    }

    public function viewticket($id)
    {
        $myticket = Mytickets::where('id',$id)->first();
        $ticketchat=Ticketchat::where('ticket_id',$id)->with('ticketBelongsTochat')->get();
        return view('admin.ticket-management.viewticket')->with('title','View Tickets')->with(compact('ticketchat','myticket'))->with('category_menu',true);
    }

    public function chatmessage(Request $request)
    {
        $ticketchat = Ticketchat::create([
            'ticket_id' => $request['ticket_id'],
            'message' => $request['message'],
            'user_id' => 1,                  
        ]);

        if(request()->hasFile('file')){
            $filepath = request()->file('file')->store('Uploads/tickets/files/'.Auth::user()->id.rand().rand(10,100), 'public');
            $file = Ticketchat::where('id',$ticketchat->id)->update (
            [
                'file_path' => $filepath,
            ]);
        }
       
        $mytickets = Mytickets::where('id',$request['ticket_id'])->update([
            'is_active' => 1,    
        ]);
        return response()->json(['status' => 1]);
    }
    
    public function ticketclosed($id)
    {
      $myticket = Mytickets::where('id',$id)->first();
      $myticket->is_active= 2;
      $myticket->save();

      return redirect()->route('admin.ticket_listing')->with('notify_success','Ticket Closed Successfuly!!');
         
    }

    public function invoice_listing()
    {
        $invoice = Invoice::get();
     return view('admin.invoice-management.list')->with('title','Invoive Listing')->with(compact('invoice'))->with('invoice_generator_menu',true);
    }

    public function invoice_generator()
    {
     return view('admin.invoice-management.add')->with('title','Invoive Listing')->with('invoice_generator_menu',true);
    }

    public function create_invoice(Request $request)
    {
        $invoice = Invoice::create([
            'company_name' => $request['company_name'],
            'bill_to' => $request['bill_to'],
            'ship_to' => $request['ship_to'],
            'invoice_no' => $request['invoice_no'],
            'date' => $request['date'],
            'date_lable' => $request['date_lable'],
            'payment_termlable' => $request['payment_termlable'],
            'payment_term' => $request['payment_term'],
            'due_date' => $request['due_date'],
            'due_datelable' => $request['due_datelable'],
            'po_lable' => $request['po_lable'],
            'tax_lable' => $request['tax_lable'],
            'tax' => $request['tax'],
            'po' => $request['po'],
            'item' => $request['item'],
            'qty' => $request['qty'],
            'rate' => $request['rate'],
            'note' => $request['note'],
            'term' => $request['term'],
            'subtotal' => $request['subtotal'],
            'subtotallable' => $request['subtotallable'],
            'discount' => $request['discount'],
            'discount_lable' => $request['discount_lable'],
            'shipping' => $request['shipping'],
            'shipping_lable' => $request['shipping_lable'],
            'total' => $request['total'],
            'amount_paid' => $request['amount_paid'],
            'amount_paidlable' => $request['amount_paidlable'],
            'blance' => $request['blance'],
        ]);

        if(request()->hasFile('img_path')){
            $thumbnail = request()->file('img_path')->store('Uploads/invoice/logo/'.$invoice->id.rand().rand(10,100), 'public');
            $image = Invoice::create (
            [
             'img_path' => $thumbnail,
            
            ]);
        }

        return response()->json(['msg' => 'Invoice Generate Successfuly!', 'status' => 1]); 
    }

    
}
