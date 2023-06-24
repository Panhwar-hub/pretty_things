@extends('layouts.main')
@section('content')

<!-- page-title -->
<div class="page-title">
    <div class="page-title__img">
        <img src="{{asset($banner->img_path)}}" alt="image" class="imgFluid" />
    </div>
    <div class="page-title__content">
        <h1 class="heading">privacy policy</h1>
    </div>
</div>

<div class="section-content mar-y">
    <div class="container">
        <div class="heading">LOREM IPSUM</div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>
</div>
@endsection
@section('css')
<style type="text/css">
	/*in page css here*/
 
</style>
@endsection
@section('js')
<script type="text/javascript">


(()=>{
  /*in page css here*/

})()
</script>
@endsection