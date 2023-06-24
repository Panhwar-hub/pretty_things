@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
  <div class="main-wrapper">
    <div class="row align-items-center mc-b-3">
      <div class="col-lg-6 col-12">
        <div class="primary-heading color-dark">
          <h2>Add Category</h2>
        </div>
      </div>

    </div>
    <form action="{{route('admin.create_category')}}" method="POST" enctype="multipart/form-data"
      class="main-form create_user_form">
      @csrf

      <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="form-group">
            <label> Category title*:</label>
            <input type="text" name="title" id="name" class="form-control" placeholder="Enter Title">
          </div>
          @if ($errors->has('title'))
          <span class="error">{{ $errors->first('title') }}</span>
          @endif
        </div>

        <div class="col-lg-6 col-md-6 col-12">
          <div class="form-group">
            <label>Slug*:</label>
            <input type="text" name="slug" id="slug" required class="form-control" placeholder="Enter Slug">
            @if ($errors->has('slug'))
            <span class="error">{{ $errors->first('slug') }}</span>
            @endif
          </div>
        </div>
        <div class="col-lg-12 text-center">
          <div class="img-upload-wrapper  mc-b-3">
            <h3>Main Image</h3>
            <figure><img src="{{asset('images/user-details.png')}}" class="thumbnail-img main_image" alt="user-img"></figure>
            <label for="thumbnails" class="user-img-btn"><i class="fa fa-camera"></i></label>
            <input type="file" required onchange="mainimage(this);" name="thumbnails" id="thumbnails" class="d-none"  accept="image/jpeg, image/png">
              <!-- <h5 class="recommend">Recommended Image Size Is: 574 X 603</h5> -->
              @if ($errors->has('thumbnails'))
                  <span class="error">{{ $errors->first('thumbnails') }}</span>
              @endif
          </div>
      </div>

        <div class="col-lg-12 col-12">
          <div class="text-center">
            <button type="submit" class="primary-btn primary-bg add-user">Add</button>
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
.recommend{
    color:#D75DB2;
}
</style>
@endsection
@section('js')

<script type="text/javascript">
  function thumb(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('.thumbnail-img').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function mainimage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.main_image').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
  
$('#name').change(function(e) {
  $.get('{{ route('admin.check_slug') }}', 
  { 'title': $(this).val() }, 
  function( data ) {
    $('#slug').val(data.slug);
  }
  );
});
    
(()=>{
    
})()
</script>
@endsection