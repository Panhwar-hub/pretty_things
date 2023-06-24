<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Models\Crawls;
use App\Models\Keywords;
use App\Http\Requests\AdminLoginRequest;

use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Lesson;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Album;
use App\Models\Review;
use App\Models\Photos;
use App\Models\Sub_category;
use Auth;
use App\Models\Faq;
use App\Models\ShopImage;
use App\Models\Flavor;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Variation;
use App\Models\Products;
use App\Models\Merchandise;
use App\Rules\PasswordMatch;
use Illuminate\Support\MessageBag;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class ShopController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
        // $favicon=Helper::OneColData('imagetable','img_path',"table_name='favicon' and ref_id=0 and is_active_img='1'");
         $logo = Imagetable::where('table_name','logo')->latest()->first();
         View()->share('logo',$logo);
        // View()->share('favicon',$favicon);
         View()->share('config',$this->getConfig());
        // $this->middleware('admin');
    }

    public function products_listing()
    {
        $products = Products::with('productBelongsToVendor')->get();
        return view('admin.products-management.list')->with('title','Products Management')->with('products_menu',true)->with(compact('products'));
    }

    public function add_products()
    {
        $cat = Category::where('is_active',1)->get();
        return view('admin.products-management.add')->with('title','Add Products')->with(compact('cat'),'products_menu',true);
    }

    public function create_products(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required',
            'new_price' => 'required|numeric',
            'long_desc' => 'required',
            'category' => 'required',
            'main_image' => 'required|mimes:jpeg,jpg,png,webp',

            // 'other_image.*' => 'image|mimes:jpeg,png,jpg,webp'
        ]);      
        if ($validator->passes()) {
            $check_slug = Products::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            }  

            $products = Products::create([
                'name'              =>  $request['name'],
                'slug'              =>  $request['slug'],
                'price'         => $request['price'],
                'new_price'         => $request['new_price'],
                'long_desc' =>  $request['long_desc'],
                'category_id' =>  $request['category'],
                'best_deal' => $request['best_deal']?1:0,
                'best_seller' => $request['best_seller']?1:0,
                'is_featured' => $request['is_featured']?1:0,
                
            ]);

            if(request()->hasFile('main_image')){
                $main_image = request()->file('main_image')->store('Uploads/products/main_image/'.$products->id.rand().rand(10,100), 'public');
                $image = Products::where('id',$products->id)->update(
                [
                    'img_path' => $main_image,
                ]);
            }
            if(request()->hasFile('other_image')){
                $documents = $request->file('other_image');  
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/products/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'products',
                        'img_path' => $image,
                        'ref_id' => $products->id,
                        'img_type' => 2
                    
                    ]);
                }
            }
            return response()->json(['msg' => 'Product Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function delete_multiimg($id)
    {
        $delete_img = ShopImage::where('id',$id)->delete();
        return back()->with('notify_success','Image Deleted!');
    }

    public function edit_products($slug)
    {
        $product = Products::where('slug',$slug)->with(['productsHasMultiImages'])->first();
        $vendor = Vendor::where('is_active',1)->get();
        $cat = Category::where('is_active',1)->get();
        return view('admin.products-management.edit')->with('title','Edit Product')->with('products_menu',true)
        ->with(compact('product','vendor','cat'));
    }

    public function saveproducts(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required',
            'new_price' => 'required|numeric',
            'category' => 'required',

        ]);      
        if ($validator->passes()) { 
            $check_slug = Products::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            } 
            
            $products = Products::where('id',$request->id)->update([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'price'         => $request['price'],
                'new_price'         => $request['new_price'],
                'long_desc' =>  $request['long_desc'],
                'category_id' =>  $request['category'],
                'best_deal' => $request['best_deal']?1:0,
                'best_seller' => $request['best_seller']?1:0,
                'is_featured' => $request['is_featured']?1:0,
                
            ]);

            if(request()->hasFile('main_image')){
                $validator = Validator::make($request->all(),[
                    'main_image' => 'required|mimes:jpeg,jpg,png,webp',
                ]);      
                $main_image = request()->file('main_image')->store('Uploads/products/main_image/'.$request->id.rand().rand(10,100), 'public');
                $image = Products::where('id',$request->id)->update(
                [
                    'img_path' => $main_image,
                ]);
            }
            if(request()->hasFile('other_image')){
                $validator = Validator::make($request->all(),[
                    'other_image' =>'required',
                    'other_image.*' => 'image|mimes:jpeg,png,jpg,webp'
                ]);  
                $documents = $request->file('other_image');
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/products/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'products',
                        'img_path' => $image,
                        'ref_id' => $request->id,
                        'img_type' => 2
                    ]);
                }
            }
            return response()->json(['msg' => 'Product Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function suspend_products($id)
    {
        $products = Products::where('id',$id)->first();
        if($products->is_active == 0)
        {
            $products->is_active= 1;
            $products->save();
            return redirect()->route('admin.products_listing')->with('notify_success','Product Activated Successfuly!!');
        }
        else{
            $products->is_active= 0;
            $products->save();
            return redirect()->route('admin.products_listing')->with('notify_success','Product Suspended Successfuly!!');
        }
    }
    
    public function feature_products($id)
    {
        $products = Products::where('id',$id)->first();
        if($products->is_featured == 0)
        {
            $products->is_featured= 1;
            $products->save();
            return redirect()->route('admin.products_listing')->with('notify_success','Product Featured Successfuly!!');
        }
        else{
            $products->is_featured= 0;
            $products->save();
            return redirect()->route('admin.products_listing')->with('notify_success','Product Removed From Featured Successfuly!!');
        }
    }

    public function delete_products($id)
    {
        $products = Products::where('id',$id)->delete();
        return redirect()->route('admin.products_listing')->with('notify_success','Product Deleted Successfuly!!');
       
    }

    public function merchandise_listing()
    {
        $merchandise = Merchandise::with('merchandiseBelongsToCategory')->get();
        return view('admin.merchandise-management.list')->with('title','Merchandise Management')->with('merchandise_menu',true)->with(compact('merchandise'));
    }

    public function add_merchandise()
    {
        $categories = Category::where('is_active',1)->get();
        return view('admin.merchandise-management.add')->with('title','Add Merchandise')->with(compact('categories'))->with('merchandise_menu',true);
    }

    public function create_merchandise(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|unique:merchandise',
            'price' => 'required',
            'qty' => 'required|numeric|min:1',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'info_desc' => 'required',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'depth' => 'required|numeric|min:1',
            'weight_pound' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'category' => 'required',
            'main_image' => 'required|mimes:jpeg,jpg,png',
            'other_image' =>'required',
            'other_image.*' => 'image|mimes:jpeg,png,jpg'
        ]);      
        if ($validator->passes()) {  
            $merchandise = Merchandise::create([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'price' => $request['price'],
                'qty' =>  $request['qty'],
                'short_desc' =>  $request['short_desc'],
                'long_desc' =>  $request['long_desc'],
                'info_desc' =>  $request['info_desc'],
                'width' =>  $request['width'],
                'height' =>  $request['height'],
                'depth' =>  $request['depth'],
                'weight_pound' =>  $request['weight_pound'],
                'weight_kg' =>  $request['weight_kg'],
                'category_id' =>  $request['category'],
               
            ]);

            if(request()->hasFile('main_image')){
                $main_image = request()->file('main_image')->store('Uploads/merchandise/main_image/'.$merchandise->id.rand().rand(10,100), 'public');
                $image = ShopImage::create(
                    [
                    'cat_type' => 'merchandise',
                    'img_path' => $main_image,
                    'ref_id' => $merchandise->id,
                    'img_type' => 1
                    
                ]);
                }
                if(request()->hasFile('other_image')){
                $documents = $request->file('other_image');  
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/merchandise/other_image/'.rand().rand(10,1000), 'public');
                    // $inner_page_name = basename($request->file('image')[$index]->getClientOriginalName(), '.'.$request->file('image')[$index]->getClientOriginalExtension());
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'merchandise',
                        'img_path' => $image,
                        'ref_id' => $merchandise->id,
                        'img_type' => 2
                    
                ]);
                }
                }

            //$users = User::get();
                return response()->json(['msg' => 'Merchandise Created Successfully!', 'status' => 1]);
            //   return redirect()->route('admin.users_listing')->with('notify_success','User Created Successfuly!!');
            }
                else
                {
                return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
                    
                }

    
    }

    public function edit_merchandise($slug)
    {
        $merchandise = Merchandise::where('slug',$slug)->with(['merchandiseBelongsToCategory','merchandiseHasMainImage','merchandiseHasMultiImages'])->first();
        // dd($product);
        $categories = Category::where('is_active',1)->get();
        return view('admin.merchandise-management.edit')->with('title','Edit Merchandise')->with('merchandise_menu',true)->with(compact('merchandise','categories'));
    }

    public function savemerchandise(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required',
            'price' => 'required',
            'qty' => 'required|numeric|min:1',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'info_desc' => 'required',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'depth' => 'required|numeric|min:1',
            'weight_pound' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'category' => 'required',
          
        ]);      
        if ($validator->passes()) { 
            $check_slug = Merchandise::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            } 
            $merchandise = Merchandise::where('id',$request->id)->update([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'price' => $request['price'],
                'qty' =>  $request['qty'],
                'short_desc' =>  $request['short_desc'],
                'long_desc' =>  $request['long_desc'],
                'info_desc' =>  $request['info_desc'],
                'width' =>  $request['width'],
                'height' =>  $request['height'],
                'depth' =>  $request['depth'],
                'weight_pound' =>  $request['weight_pound'],
                'weight_kg' =>  $request['weight_kg'],
                'category_id' =>  $request['category'],
            ]);

            if(request()->hasFile('main_image')){
                $validator = Validator::make($request->all(),[
                    'main_image' => 'required|mimes:jpeg,jpg,png',
                ]);      
                $main_image = request()->file('main_image')->store('Uploads/merchandise/main_image/'.$request->id.rand().rand(10,100), 'public');
                $delete_img = ShopImage::where('cat_type','merchandise')->where('ref_id',$request->id)->where('img_type',1)->delete();
                $image = ShopImage::create(
                    [
                    'cat_type' => 'merchandise',
                    'img_path' => $main_image,
                    'ref_id' => $request->id,
                    'img_type' => 1
                ]);
            }
            if(request()->hasFile('other_image')){
                $validator = Validator::make($request->all(),[
                    'other_image' =>'required',
                    'other_image.*' => 'image|mimes:jpeg,png,jpg'
                ]);  
                $documents = $request->file('other_image');
                $delete_img = ShopImage::where('cat_type','merchandise')->where('ref_id',$request->id)->where('img_type',2)->delete();  
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/merchandise/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'merchandise',
                        'img_path' => $image,
                        'ref_id' => $request->id,
                        'img_type' => 2
                    ]);
                }
            }
            return response()->json(['msg' => 'Merchandise Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function suspend_merchandise($id)
    {
        $merchandise = Merchandise::where('id',$id)->first();
        if($merchandise->is_active == 0)
        {
            $merchandise->is_active= 1;
            $merchandise->save();
            return redirect()->route('admin.merchandise_listing')->with('notify_success','Merchandise Activated Successfuly!!');
        }
        else{
            $merchandise->is_active= 0;
            $merchandise->save();
            return redirect()->route('admin.merchandise_listing')->with('notify_success','Merchandise Suspended Successfuly!!');
        }
    }

    public function delete_merchandise($id)
    {
        $merchandise = Merchandise::where('id',$id)->with(['merchandiseHasMainImage','merchandiseHasMultiImages'])->delete();
        return redirect()->route('admin.merchandise_listing')->with('notify_success','Merchandise Deleted Successfuly!!');
       
    }

    public function suspend_flavor($id)
    {
        $flavor = Flavor::where('id',$id)->first();
        if($flavor->is_active == 0)
        {
            $flavor->is_active= 1;
            $flavor->save();
            return redirect()->route('admin.flavor_listing')->with('notify_success','Flavor Activated Successfuly!!');
        }
        else{
            $flavor->is_active= 0;
            $flavor->save();
            return redirect()->route('admin.flavor_listing')->with('notify_success','Flavor Suspended Successfuly!!');
        }
    }

    public function delete_flavor($id)
    {
        $color = Flavor::where('id',$id)->delete();
        return redirect()->route('admin.flavor_listing')->with('notify_success','Flavor Deleted Successfuly!!');
       
    }

    public function flavor_listing()
    {
        $flavor = Flavor::latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.flavor-management.list')->with('title','Flavor Management')->with('flavor_menu',true)->with(compact('flavor'));
    }

    public function add_flavor()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.flavor-management.add')->with('title','Add Flavor')->with('flavor_menu',true);
    }

    public function create_flavor(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            // 'type' => 'required',
        ]);  

        $flavor = Flavor::create([
            // 'faq_type_id' => $request['type'],
            'name' => $request['name'],
            'code' => $request['code'],
           
           
        ]);

       

          return redirect()->route('admin.flavor_listing')->with('notify_success','Flavor Created Successfuly!!');
    }

    public function edit_flavor($id)
    {
        $flavor = Flavor::where('id',$id)->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.flavor-management.edit')->with('title','Edit Flavor')->with('flavor_menu',true)->with(compact('flavor'));
    }

    public function saveflavor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);  

        $flavor = Flavor::where('id',$request->id)->update([
            'name' => $request['name'],
            'code' => $request['code'],
        ]);
        return redirect()->route('admin.flavor_listing')->with('notify_success','Flavor Updated Successfuly!!');
    }

    public function suspend_size($id)
    {
        $size = Size::where('id',$id)->first();
        if($size->is_active == 0)
        {
            $size->is_active= 1;
            $size->save();
            return redirect()->route('admin.size_listing')->with('notify_success','Size Activated Successfuly!!');
        }
        else{
            $size->is_active= 0;
            $size->save();
            return redirect()->route('admin.size_listing')->with('notify_success','Size Suspended Successfuly!!');
        }
    }

    public function delete_size($id)
    {
        $size = Size::where('id',$id)->delete();
        return redirect()->route('admin.size_listing')->with('notify_success','Size Deleted Successfuly!!');
       
    }

    public function size_listing()
    {
        $size = Size::latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.size-management.list')->with('title','Size Management')->with('size_menu',true)->with(compact('size'));
    }

    public function add_size()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.size-management.add')->with('title','Add Size')->with('size_menu',true);
    }

    public function create_size(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            // 'type' => 'required',
        ]);  

        $size = Size::create([
            // 'faq_type_id' => $request['type'],
            'name' => $request['name'],
            'code' => $request['code'],
           
           
        ]);

       

          return redirect()->route('admin.size_listing')->with('notify_success','Size Created Successfuly!!');
    }

    public function edit_size($id)
    {
        $size = Size::where('id',$id)->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.size-management.edit')->with('title','Edit Size')->with('size_menu',true)->with(compact('size'));
    }

    public function savesize(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);  

        $size = Size::where('id',$request->id)->update([
            'name' => $request['name'],
            'code' => $request['code'],
        ]);

        return redirect()->route('admin.size_listing')->with('notify_success','Size Updated Successfuly!!');
    }

    public function suspend_variation($id)
    {
        $variation = Variation::where('id',$id)->first();
        if($variation->is_active == 0)
        {
            $variation->is_active= 1;
            $variation->save();
            return redirect()->route('admin.variation_listing')->with('notify_success','Variation Activated Successfuly!!');
        }
        else{
            $variation->is_active= 0;
            $variation->save();
            return redirect()->route('admin.variation_listing')->with('notify_success','Variation Suspended Successfuly!!');
        }
    }

    public function delete_variation($id)
    {
        $variation = Variation::where('id',$id)->delete();
        return redirect()->route('admin.variation_listing')->with('notify_success','Variation Deleted Successfuly!!');
       
    }

    public function variation_listing()
    {
        $variation = Variation::with('variationBelongsToColor','variationBelongsToProduct')->latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.variation-management.list')->with('title','Variation Management')->with('variation_menu',true)->with(compact('variation'));
    }

    public function add_variation()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        $products = Products::where('is_active',1)->latest()->get();
        $color = Color::where('is_active',1)->latest()->get();
        return view('admin.variation-management.add')->with('title','Add Variation')->with('variation_menu',true)->with(compact('products','color'));
    }

    public function create_variation(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'product'=> 'required',
            'color'=> 'required',
            'size_name' => 'required',
            
            // 'type' => 'required',
        ]);  

        $variation = Variation::create([
            // 'faq_type_id' => $request['type'],
            'product_id' => $request['product'],
            'color_id' => $request['color'],
            'size_name' => $request['size_name'],
           
           
        ]);

       

          return redirect()->route('admin.variation_listing')->with('notify_success','Variation Created Successfuly!!');
    }

    public function edit_variation($id)
    {
        $variation = Variation::where('id',$id)->first();
        $products = Products::where('is_active',1)->latest()->get();
        $color = Color::where('is_active',1)->latest()->get();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.variation-management.edit')->with('title','Edit Variation')->with('variation_menu',true)->with(compact('variation','products','color'));
    }

    public function savevariation(Request $request)
    {
        $request->validate([
            'product'=> 'required',
            'color'=> 'required',
            'size_name' => 'required',
        ]);  

        $variation = Variation::where('id',$request->id)->update([
            'product_id' => $request['product'],
            'color_id' => $request['color'],
            'size_name' => $request['size_name'],
        ]);

          return redirect()->route('admin.variation_listing')->with('notify_success','Variation Updated Successfuly!!');
    }

}
