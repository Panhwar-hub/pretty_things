@extends('layouts.main')
@section('content')

<!-- page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">Contact us</h1>
    </div>
</div>


<!-- Contact Us -->
<div class='contact mar-y'>
    <div class='container'>
        <div class='row'>
            <div class='col-12 col-lg-5'>
                <div class='contact__img'>
                    <img src='images/contact-img.png' alt='image' class='imgFluid' loading='lazy'>
                </div>
            </div>
            <div class='col-12 col-lg-7'>
                <div class="contactFormWrapper">
                    <h2 class="heading">Contact Information</h2>
                    <h3 class="subHeading">Contact Information</h3>
                    <form id='contact' action='{{route('contact-us-submit')}}' method='post'>
                        @CSRF
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-6">
                                <div class="contact-form__fields">
                                    <input type="text" placeholder="First Name" name="fname">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="contact-form__fields">
                                    <input type="text" placeholder="Last Name" name="lname">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="contact-form__fields">
                                    <input type="email" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="contact-form__fields">
                                    <input type="tel" placeholder="Phone Number" name="phone">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <textarea rows="6" placeholder="Message" name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <button class="themeBtn">Send Message</button>
                                </div>
                            </div>
                        </div>

                    </form>
                    <ul class="contact-details">
                        <li class="contact-details__single">
                            <a href="tel:{{$config['COMPANYPHONE']}}">
                                <i class='bx bx-phone-call bx-tada'></i>
                                {{$config['COMPANYPHONE']}}
                            </a>
                        </li>
                        <li class="contact-details__single">
                            <a href="mailto:{{$config['EXTERNALEMAIL']}}">
                                <i class='bx bx-envelope'></i>
                                {{$config['EXTERNALEMAIL']}}
                            </a>
                        </li>
                        <li class="contact-details__single">
                            <address>
                                <i class='bx bx-map'></i>
                                {{$config['COMPANYADDRESS']}}
                            </address>
                        </li>
                    </ul>
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