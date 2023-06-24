

<header class="header">
    <div class="container">
        <div class="header-top">
            <ul class="header-top__followers">
                <li><a href="{{$config['INSTAGRAM']}}"><i class='bx bxl-instagram'></i>100k followers</a></li>
                <li><a href="{{$config['FACEBOOK']}}"><i class='bx bxl-facebook-circle'></i>300k followers</a></li>
            </ul>
            <ul class="header-top__settings">
                <li>
                    <select>
                        <option value="English">English</option>
                    </select>
                </li>
                <li>
                    <select>
                        <option value="USD">USD</option>
                    </select>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="header-main">
            <a href="{{route('home')}}" class="header-main__logo">
                <img src="{{asset($logo->img_path)}}" alt="Logo" class="imgFluid" />
            </a>
            <div class="headermain__categoriesWrapper">
                <select class="header-main__categories">
                    <option value="All Categories">All Categories</option>
                </select>
            </div>
            <form action="#" class="header-main__search">
                <input type="search" placeholder="Search products">
                <button><i class='bx bx-search'></i></button>
            </form>
            <ul class="header-main__actions">
                <li><a href="#"><i class='bx bx-heart'></i></a></li>
                @if(Auth::check())
                        <li><a href="{{route('signout')}}"><i class='bx bxs-logout'></i></a></li>                      
                        <li><a href="{{ route('dashboard.myProfile') }}"><i class='bx bxs-user'></i></a></li>                      
                @else
                <li><a href="{{route('sign-in')}}"><i class='bx bx-user'></i></a></li>
                @endif
            </ul>

        </div>
    </div>
    <div class="header__nav--bgWrapper">
        <div class="container">
            <ul class="header__nav header__nav--bg">
                <li><a href="{{route('home')}}">Home </a></li>
                <li><a href="{{route('about-us')}}">About Us</a></li>
                <li><a href="{{route('products')}}">products</a></li>
                <li><a href="{{route('contact-us')}}">Contact us</a></li>
            </ul>
        </div>
    </div>
    </div>
    <div class="container">
        <ul class="header__nav headerNavSlider">
            @foreach ($all_categories as $cat)
            <li><a href="{{route('products', 'slug='.$cat->slug)}}"><img src="{{asset($cat->img_path)}}" alt='image' class='imgFluid' loading='lazy'> {{$cat->title}}</a></li>
            @endforeach
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-1.png')}}" alt='image' class='imgFluid' loading='lazy'> cell phone</a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'> smart watch’s </a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-3.png')}}" alt='image' class='imgFluid' loading='lazy'> shoes </a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-4.png')}}" alt='image' class='imgFluid' loading='lazy'> t shirt</a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-5.png')}}" alt='image' class='imgFluid' loading='lazy'> glasses</a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-6.png')}}" alt='image' class='imgFluid' loading='lazy'> school bag</a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-7.png')}}" alt='image' class='imgFluid' loading='lazy'> smart selfie stick</a></li>-->
            <!--<li><a href="{{route('products')}}"><img src="{{asset('images/navigation-img-4.png')}}" alt='image' class='imgFluid' loading='lazy'> t shirt</a></li>-->
        </ul>
    </div>
</header>
