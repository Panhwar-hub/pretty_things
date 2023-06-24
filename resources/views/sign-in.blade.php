@extends('layouts.main')
@section('content')

<!-- Page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">Log In</h1>
    </div>
</div>

<!-- Log In -->
<div class="auth mar-y">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="auth__form">
                    <img src='{{asset('images/auth-bg.png')}}' alt='image' class='imgFluid bg-img ' loading='lazy'>
                    <div class="section-content text-center mb-4">
                        <h2 class="heading">Log In</h2>
                    </div>
                    <form  method="POST" action="{{route('sign-in-submit')}}" >
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="inputField">
                                    <input type="email" id="email" required name="email" value="{{old('email')}}" placeholder="Enter Email :">
                                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="inputField">
                                    <input type="password" id="passwordInput" required name="password"  placeholder="Enter Password :" id="passwordInput">
                                    <span class="icon showPassword" onclick="showHide()"><i class="fa-solid fa-eye"></i></span>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="themeBtn themeBtn--center">LOGIN</button>
                            </div>
                            <div class="col-12">
                                <div class="auth__bottom">
                                    <p>Don’t have an account? <a href="{{route('sign-up')}}">Sign Up</a> </p>
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