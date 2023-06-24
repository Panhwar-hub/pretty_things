<div class="side-bar">
      <div class="side-bar-logo">
          
        <a  href="{{route('admin.dashboard')}}"><img src="{{asset($logo->img_path)}}" alt="logo"></a>

      </div>
      <div class="side-bar-links">
        <ul class="navigation-list">
           
          <li class="{{isset($user_menu)?'active':''}}"><a href="{{route('admin.dashboard')}}">
              <figure class="mb-0"><img src="{{asset('admin/images/side-link-8.svg')}}" alt="side-links-img"></figure> Dashboard
            </a></li>
            <li class="{{isset($user_mgmmenu)?'active':''}}"><a href="{{route('admin.users_listing')}}">
              <figure class="mb-0"><img src="{{asset('admin/images/side-link-1.svg')}}" alt="side-links-img"></figure> User Management
            </a></li>
           
            <!-- <li class="{{-- isset($faq_menu)?'active':'' --}}"><a href="{{-- route('admin.faq_listing') --}}">
              <figure class="mb-0"><img src="{{-- asset('admin/images/side-link-8.svg') --}}" alt="side-links-img"></figure> Faq Management
            </a></li> -->

            {{-- <li><a href="{{route('admin.newsletter_listing')}}">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-7.svg') }}" alt="side-links-img"></figure> Newsletter Management
            </a></li> --}}
            
            {{-- <li class="{{ isset($testimonial_menu)?'active':'' }}"><a href="{{ route('admin.testimonial_listing') }}">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-8.svg') }}" alt="side-links-img"></figure> Testimonial Management
            </a></li> --}}
            
            <!-- <li class="{{-- isset($news_menu)?'active':'' --}}"><a href="{{-- route('admin.news_events_listing') --}}">
              <figure class="mb-0"><img src="{{-- asset('admin/images/side-link-8.svg') --}}" alt="side-links-img"></figure> News/Events Management
            </a></li> -->
            <li class="{{ isset($category_menu)?'active':'' }}"><a href="{{ route('admin.category_listing') }}">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-2.svg') }}" alt="side-links-img"></figure> Category Management
            </a></li>
            <li class="{{ isset($reviews_menu)?'active':'' }}"><a href="{{ route('admin.reviews_listing') }}">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-8.svg') }}" alt="side-links-img"></figure> Reviews Management
            </a></li>
          
            {{-- <li class="{{ isset($invoice_generator_menu)?'active':'' }}"><a href="https://invoice-generator.com/#/5">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-9.svg') }}" alt="side-links-img"></figure> Invoice Generater
            </a></li> --}}
            
            <li class="{{isset($products_menu)?'active':''}}"><a href="{{route('admin.products_listing')}}">
              <figure class="mb-0"><img src="{{asset('admin/images/side-link-5.svg')}}" alt="side-links-img"></figure> Products Management
            </a></li>

            <li class="{{ isset($order_inquiry_menu)?'active':''}}"><a href="{{route('admin.orders_inquiry')}}">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-4.svg')}}" alt="side-links-img"></figure> Orders Inquiries Management
            </a></li>
            {{-- <li class="{{ isset($order_menu)?'active':'' }}"><a href="{{ route('admin.orders') }}">
              <figure class="mb-0"><img src="{{ asset('admin/images/side-link-9.svg') }}" alt="side-links-img"></figure> Orders Management
            </a></li> --}}
             
            {{-- <li><a href="{{ route('admin.inquiries_listing') }}">
                <figure class="mb-0"><img src="{{ asset('admin/images/side-link-7.svg') }}" alt="side-links-img"></figure> Inquiries Management
              </a></li> --}}

          <li class="li-dropdown"><a href="javascript:void(0)">
              <figure class="mb-0"><img src="{{asset('admin/images/side-link-9.svg')}}" alt="side-links-img"></figure> Site Settings
            </a>
            <div class="dropdown-content">
            <ul>
                <li><a href="{{route('admin.showLogo')}}">Logo Management</a></li>
                <li><a href="{{route('admin.socialInfo')}}">Contact / Social Info</a></li>
                <li><a href="{{route('admin.homeSlider')}}">Banners Management</a></li>
                {{-- <li><a href="{{route('admin.welcomeSlider')}}">Welcome Slider</a></li> --}}
               
            </ul>
            </div>
        </li>
        
        </ul>
      </div>
    </div>