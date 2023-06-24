@extends('layouts.main')
@section('content')

<!-- Page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">About Us</h1>
    </div>
</div>

<!-- About US -->
<div class='about mar-y'>
    <div class='container'>
        <div class='row'>
            <div class='col-12 col-lg-6'>
                <div class='about__img about__img--fancy'>
                    <img src='{{asset('images/about-img-1.png')}}' alt='image' class='imgFluid'>
                    <img src='{{asset('images/about-img-2.png')}}' alt='image' class='imgFluid'>
                </div>
            </div>
            <div class='col-12 col-lg-6'>
                <div class='about__content'>
                    <div class='section-content'>
                        <h2 class='subHeading'>About us</h2>
                        <?php App\Helpers\Helper::inlineEditable("h3",["class"=>"heading"],"Who we are",'ABOUTHEAD');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'ABOUTDESC1');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'ABOUTDESC2');?>
                        
                    </div>
                </div>
            </div>
            <div class='col-12 mt-5 pt-3'>
                <div class='about__content'>
                    <div class='section-content'>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'ABOUTDESC3');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'ABOUTDESC4');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'ABOUTDESC5');?>

                    </div>
                </div>
            </div>
        </div>
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