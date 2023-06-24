@extends('layouts.main')
@section('content')

 <!-- Pagetitle -->


<?php 
        Session::forget('cart');
         Session::forget('ser');
         Session::forget('cartId');
         Session::forget('mail_data');
         Session::forget('order_id');
         Session::forget('discoupon_session');
 ?>
                <div class="cart-page my-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                            <h3>Order Placed Successfully!</h3>
                            <li class="list-inline-item"><a href="{{route('home')}}" class="themeBtn">
                Back To Home</a></li>
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

})()
</script>
@endsection