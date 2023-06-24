 <!-- DASHBOARD START -->

    <section class="dashboard-sidebar">
        <div class="dashboard-sidebar-logo">
            <a href="{{route('home')}}" title="Visit Site"><img src="{{asset($logo->img_path)}}" alt="dashboard-logo"></a>
        </div>
        <div class="dashboard-sidebar-links">
            <ul>
                 <li class="{{isset($myProfileMenu) ? 'active' : ''}}"><a href="{{route('dashboard.myProfile')}}">
                        <figure class="mb-0"><img src="{{asset('userdash/images/dashboard-link-4.png')}}" alt="dashboard-link-icon"></figure>
                        <span>My Profile</span>
                    </a></li>
                    <li class="{{isset($passChangeMenu) ? 'active' : ''}}"><a href="{{route('dashboard.passwordChange')}}">
                        <figure class="mb-0"><img src="{{asset('userdash/images/dashboard-link-4.png')}}" alt="dashboard-link-icon"></figure>
                        <span>Change Password</span>
                    </a></li>
               
                <li class="{{isset($mybookingMenu) ? 'active' : ''}}"><a href="{{route('dashboard.myBookings')}}">
                        <figure class="mb-0"><img src="{{asset('userdash/images/dashboard-link-2.png')}}" alt="dashboard-link-icon"></figure>
                        <span>My Orders</span>
                    </a></li>

                    <li class="{{ isset($myticketsMenu) ? 'active' : '' }}"><a href="{{ route('dashboard.mytickets') }}">
                        <figure class="mb-0"><img src="{{ asset('userdash/images/dashboard-link-2.png') }}" alt="dashboard-link-icon"></figure>
                        <span>My Tickets</span>
                    </a></li>
               
                    <li class=""><a href="{{route('home')}}">
                        <figure class="mb-0"><img src="{{asset('userdash/images/dashboard-link-1.png')}}" alt="dashboard-link-icon"></figure>
                        <span>Visit Site</span>
                    </a></li>
               
                <li><a href="{{route('signout')}}">
                        <figure class="mb-0"><img src="{{asset('userdash/images/dashboard-link-5.png')}}" alt="dashboard-link-icon"></figure>
                        <span>Logout</span>
                    </a></li>
            </ul>
        </div>
    </section>