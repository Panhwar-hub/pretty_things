@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
            <div class="main-wrapper">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Add Product</h2>
                        </div>
                    </div>
                   
                </div>
                <div class="user-wrapper">
                    <form id="add-record-form"  class="main-form mc-b-3">

                        @csrf
                        <div class="row align-items-end">
                       
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Name*:</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" required class="form-control" placeholder="Enter Product Name">
                                    @if ($errors->has('name'))
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Slug*:</label>
                                    <input type="text" name="slug"  readonly id="slug" value="{{old('slug')}}" required class="form-control" placeholder="Enter Slug">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Old Price ($)*:</label>
                                    <input type="number" name="price" id="price" value="{{old('price')}}" min="1"  class="form-control" placeholder="Enter Old Price in $">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>New Price ($)*:</label>
                                    <input type="number" name="new_price" id="new_price" value="{{old('new_price')}}" min="1"  class="form-control" placeholder="Enter New Price in $">
                                </div>
                            </div>
                          
                            <!--<div class="col-lg-4 col-md-4 col-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>SalePrice ($)*:</label>-->
                            <!--        <input type="number" name="sale_price" id="sale_price" value="{{old('sale_price')}}" min="1"  class="form-control" placeholder="Enter Saleprice in $">-->
                            <!--    </div>-->
                            <!--</div>-->
                          
                            <!--<div class="col-lg-4 col-md-4 col-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>Sku*:</label>-->
                            <!--        <input type="text" name="sku" id="sku" value="{{old('sku')}}" min="1"  class="form-control" placeholder="Enter Product Sku">-->
                            <!--    </div>-->
                            <!--</div>-->
                          
                           
                            <!--<div class="col-lg-4 col-md-4 col-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>Qty*:</label>-->
                            <!--        <input type="number" name="qty" id="qty" value="{{old('qty')}}" min="1" required class="form-control" placeholder="Enter Qty">-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Category:</label>
                                   <select name="category" class="form-control cat-dd" required>
                                   <option selected value="">Select A Category</option>
                                       @foreach($cat as $c)
                                       <option value="{{$c->id}}">{{$c->title}}</option>
                                       @endforeach
                                   </select>
                                   
                                </div>
                            </div>

                            {{-- <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Short Description:</label>
                                    <textarea rows="5" class="form-control ckeditor" id="editor1"
                                        placeholder="Enter Short Description">{{old('short_desc')}}</textarea>
                                    <input type="hidden" id="message1" name="short_desc">
                                </div>
                            </div> --}}
        
                            <div class="col-lg-12 col-md-12 col-12 row">
                                <div class="col-lg-4 col-md-4 col-4">
                                    <div class="form-group">
                                        <label> Best Deal:</label>
                                        <input type="checkbox" name="best_deal">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-4">
                                    <div class="form-group">
                                        <label> Best Seller:</label>
                                        <input type="checkbox" name="best_seller">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-4">
                                    <div class="form-group">
                                        <label> Featured product:</label>
                                        <input type="checkbox" name="is_featured">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label> Description:</label>
                                    <textarea rows="5" class="form-control ckeditor" id="editor2"
                                        placeholder="Enter Long Description">{{old('long_desc')}}</textarea>
                                    <input type="hidden" id="message2" name="long_desc">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="img-upload-wrapper  mc-b-3">
                              <h3>Main Image</h3>
                              <figure><img src="{{asset('images/user-details.png')}}" class="thumbnail-img main_image" alt="user-img"></figure>
                              <label for="main_image" class="user-img-btn"><i class="fa fa-camera"></i></label>
                              <input type="file" required onchange="mainimage(this);" name="main_image" id="main_image" class="d-none"  accept="image/jpeg, image/png">
                                <!-- <h5 class="recommend">Recommended Image Size Is: 574 X 603</h5> -->
                                @if ($errors->has('main_image'))
                                    <span class="error">{{ $errors->first('main_image') }}</span>
                                @endif
                            </div>

                            <div class="img-upload-wrapper  mc-b-3">
                              <h3>Other Images (You Can Select Multiple Images)</h3>
                              <figure><img src="{{asset('images/user-details.png')}}" class="thumbnail-img other_image" alt="user-img"></figure>
                              <label for="other_image" class="user-img-btn"><i class="fa fa-camera"></i></label>
                              <input type="file"  onchange="otherimage(this);" name="other_image[]" id="other_image" class="d-none"  accept="image/jpeg, image/png" multiple>
                                <!-- <h5 class="recommend">Recommended Image Size Is: 574 X 603</h5> -->
                                @if ($errors->has('other_image'))
                                    <span class="error">{{ $errors->first('other_image') }}</span>
                                @endif
                            </div>
                          
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="text-center">
                            
                            <button id="add-record" type="button" class="primary-btn primary-bg">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
                
            </div>
        </div>
    </section>

@endsection
@section('css')
<link rel="stylesheet" href="jquery-ui-multiselect-widget-master/jquery.multiselect.css" />
<style type="text/css">
    
	/*in page css here*/
.thumbnail-img {
    max-width: 288px;
    height: 113px;
}
.picture {
    max-width: 288px;
    height: 113px;
}
.recommend{
    color:#D75DB2;
}
</style>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
{{-- <script src="jquery-ui-multiselect-widget-master/src/jquery.multiselect.js" type="text/javascript"></script> --}}
<script type="text/javascript">

function mainimage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.main_image').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function otherimage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.other_image').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


(()=>{
    
    $('#name').change(function(e) {
        $.get('{{ route('admin.check_slug') }}', 
            { 'title': $(this).val() }, 
            function( data ) {
            $('#slug').val(data.slug);
            }
        );
    });

    $( "#add-record" ).click(function(e) {
        Loader.show();
        e.preventDefault();
        // var value1 = CKEDITOR.instances['editor1'].getData();
        // var val1 = $("#message1").val(value1);

        var value2 = CKEDITOR.instances['editor2'].getData();
        var val2 = $("#message2").val(value2);
        var data = new FormData(document.getElementById("add-record-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
    			type:'POST',
    			url:'{{route('admin.create_products')}}',
    			data:data,
			    enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
    			success:function(data) {
                    Loader.hide();
                if(data.status == 1){
                        $.toast({
                        heading: 'Success!',
                        position: 'top-right',
                        text:  data.msg,
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 2500,
                        stack: 6
                    });
                    $('#add-record-form')[0].reset();
                    setInterval(() => {
                        
                         window.location.href = "{{route('admin.products_listing')}}";
                    }, 2500);
                }
                if(data.status == 2){
                    $.toast({
                        heading: 'Error!',
                        position: 'bottom-right',
                        text:  data.error,
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
    	    }
        });
    });
    
})()
</script>
@endsection