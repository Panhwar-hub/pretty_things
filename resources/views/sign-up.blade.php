@extends('layouts.main')
@section('content')

<!-- Page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">Sign Up</h1>
    </div>
</div>

<!-- Sign Up -->
<div class="auth mar-y">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="auth__form">
                    <img src='images/auth-bg.png' alt='image' class='imgFluid bg-img ' loading='lazy'>
                    <div class="section-content text-center mb-4">
                        <h2 class="heading">Sign Up</h2>
                    </div>
                    <form method="POST" id="formvalidate" action="{{route('sign-up')}}">
                        @CSRF
                        <div class="row">
                            <div class="col-12">
                                <div class="inputField">
                                    <input type="text" name="fullname" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="inputField">
                                    <input type="email" name="email" placeholder="Email">
                                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="inputField">
                                    <input type="password" name="password" placeholder="Enter Password :" id="passwordInput">
                                    <span class="icon showPassword" onclick="showHide()"><i class="fa-solid fa-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="themeBtn themeBtn--center">SIGN
                                    UP</button>
                            </div>
                            <div class="col-12">
                                <div class="auth__bottom">
                                    <p>Already have an account? <a href="login.php">Log In </a> </p>
                                </div>
                            </div>
                        </div>
                    </form>
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