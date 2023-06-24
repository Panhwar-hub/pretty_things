


<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 wow zoomInLeft" data-wow-duration=" 2s">
                <div class="footer__quickLinks">
                    <div class="title">CONTACT DETAILS </div>
                    <ul>
                        <li>
                            <address><i class='bx bx-map'></i>{{$config['COMPANYADDRESS']}}</address>
                        </li>
                        <li><a href="tel:{{$config['COMPANYPHONE']}}"><i class='bx bxs-phone'></i>{{$config['COMPANYPHONE']}}</a></li>
                        <li><a href="mailto:{{$config['EXTERNALEMAIL']}}"><i class='bx bxs-envelope'></i>{{$config['COMPANYEMAIL']}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-2 wow zoomInLeft" data-wow-duration=" 1.75s">
                <div class="footer__quickLinks">
                    <div class="title">Quik Links</div>
                    <ul>
                        <li><a href="{{route('home')}}"><i class='bx bx-chevron-right'></i>Home</a></li>
                        <li><a href="{{route('about-us')}}"><i class='bx bx-chevron-right'></i>About Us</a></li>
                        <li><a href="{{route('products')}}"><i class='bx bx-chevron-right'></i>Products</a></li>
                        <li><a href="{{route('contact-us')}}"><i class='bx bx-chevron-right'></i>Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-3 wow zoomInLeft" data-wow-duration=" 1.25s">
                <div class="footer__quickLinks">
                    <div class="title">PRODUCTS </div>
                    <ul>
                        <li><a href="{{route('products')}}"><i class='bx bx-chevron-right'></i>Best Seller</a></li>
                        <li><a href="{{route('products')}}"><i class='bx bx-chevron-right'></i>New Arrivlas</a></li>
                        <li><a href="{{route('products')}}"><i class='bx bx-chevron-right'></i>Best Sales</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-4 wow zoomInLeft" data-wow-duration=" 1s">
                <div class="footer__newletter">
                    <div class="title"> JOIN OUR NEWSLETTER NOW </div>
                    <form action="#">
                        <input type="email" placeholder="Email Address">
                        <button>
                            GO
                        </button>
                    </form>
                    <p>Get mail updates abput our tatestoffers</p>
                    <ul class="footer-social">
                        <li>
                            <a href="{{$config['FACEBOOK']}}"><i class="bx bxl-facebook-square"></i></a>
                        </li>
                        <li>
                            <a href="{{$config['TWITTER']}}"><i class="bx bxl-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{$config['INSTAGRAM']}}"><i class="bx bxl-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 wow zoomInUp">
                <div class="footer__copyright">
                </div>
                <div class="footer__copyright">
                    <?php App\Helpers\Helper::inlineEditable("p",["class"=>""]," Copyright &copy; 2022 All Rights Reserved ",'SNOOKERICEFOOTERTXT2');?>
                </div>
            </div>
        </div>
    </div>
</footer>