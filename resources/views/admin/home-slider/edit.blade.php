@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
            <div class="main-wrapper">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="primary-heading color-dark">
                            <h2>EDIT BANNER</h2>
                        </div>
                    </div>
                   
                </div>
                <div class="user-wrapper">
                    <form id="add-record-form" action="{{route('admin.updatehomeSlider')}}" enctype="multipart/form-data" method="POST" class="main-form mc-b-3">

                        @csrf
                        <div class="row ">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                <label>Table Name*:</label>
                                    <input type="text" id="table_name"  name="table_name" placeholder="Enter Heading" value="{{$home_slider->table_name}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                <label>Banner Heading*:</label>
                                    <input type="text" id="headings"  name="headings" placeholder="Enter Heading" value="{{$home_slider->headings}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                <label>Banner Description*:</label>
                                    <input type="text" id="description"  name="description" placeholder="Enter Description" value="{{$home_slider->description}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                <label>Type*:</label>
                                    <select name="type" id="type" selected="{{$home_slider->type}}">
                                        <option value="2">Home Page Slider</option>
                                        <option value="3">Other Pages Banner</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id"  value="{{$home_slider->id }}" >
                        <input type="hidden" name="table_name"  value="{{ $home_slider->table_name }}" >
                        <div class="col-lg-12 text-center">
                            <div class="img-upload-wrapper  mc-b-3">
                              <h3>Banner Image</h3>
                              <figure><img src="{{asset($home_slider->img_path)}}" class="thumbnail-img" alt="user-img"></figure>
                              <label for="thumbnail-img" class="user-img-btn"><i class="fa fa-camera"></i></label>
                              <input type="file" required onchange="thumb(this);" name="homeslider" id="thumbnail-img" class="d-none"  accept="image/jpeg, image/png" >
                            </div>
                           </div>
                           
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="text-center">
                          
                            <button id="add-record" type="button" class="primary-btn primary-bg">Update</button>
                        </div>
                    </div>
                    </form>

                </div>
                
            </div>
        </div>
    </section>

@endsection
@section('css')
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
</style>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
function thumb(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.thumbnail-img')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

(()=>{

    $('#add-record').click(function(e)
    {
        console.log($("#thumbnail-img").val())

        // if($("#thumbnail-img").val() == "")
        // {
        //     $.toast({
        //             heading: 'Error!',
        //             position: 'bottom-right',
        //             text:  'Please Select A Banner Image!',
        //             loaderBg: '#ff6849',
        //             icon: 'error',
        //             hideAfter: 2000,
        //             stack: 6
        //         });
        // }
        // else
        // {
            $('#add-record-form').submit();
        // }

    });
    // $('#add-record').click(function(e)
    // {
    //     e.preventDefault();
    //     var value1 = CKEDITOR.instances['editor1'].getData();
    //     var val1 = $("#message1").val(value1);
    // $('#add-record-form').submit();
               
    // });
    
})()
</script>
@endsection