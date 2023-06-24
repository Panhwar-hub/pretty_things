@extends('layouts.main')
@section('content')

<!-- Page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">Products</h1>
    </div>
</div>

<!-- Products -->
<div class='products mar-y'>
    <div class='container'>
        <div class="row ">
            <div class="col-12 col-lg-3">
                <div class="products-categories section-box">
                    <div class="products-categories__title">Categories</div>
                    <form action="#">
                        <div id="my-slider" se-min="0" se-step="1" se-min-value="40" se-max-value="60" se-max="100" class="rangeSlider">
                            <div class="slider-touch-left">
                                <span></span>
                            </div>
                            <div class="slider-touch-right">
                                <span></span>
                            </div>
                            <div class="slider-line">
                                <span></span>
                            </div>
                        </div>
                        <div class="resultWrapper">
                            <div id="resultFrom" class="rangeResult">
                                From : <b>$500</b>
                            </div>
                            <div id="resultTo" class="rangeResult">
                                To : <b>$1,000</b>
                            </div>
                        </div>
                        <div class="products-categories__filters">
                            <div class="title">Color</div>
                            <ul>
                                <li><a href="javascript:void(0)" class="filter_category filter_cate" data-slug="all">All Products</a></li>
                                @foreach($category as $key => $cat)
                                <li><a href="javascript:void(0)" class="filter_category filter_cate" data-slug="{{$cat->slug}}">{{$cat->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <div class="products-categories__filters">
                            <div class="title">Color</div>
                            <ul>
                                <li>
                                    <input type="checkbox" id="color1">
                                    <label for="color1">lorem</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="color2">
                                    <label for="color2">lorem</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="color3">
                                    <label for="color3">lorem</label>
                                </li>
                            </ul>
                        </div> --}}
                        
                        {{-- <div class="products-categories__filters">
                            <div class="title">Items</div>
                            <ul>
                                <li>
                                    <input type="checkbox" id="Items1">
                                    <label for="Items1">lorem</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Items2">
                                    <label for="Items2">lorem</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Items3">
                                    <label for="Items3">lorem</label>
                                </li>
                            </ul>
                        </div> --}}
                        {{-- <button class="themeBtn">Filter</button> --}}
                    </form>
                </div>
                <div class="section-box">
                    <div class="products-categories__title">New Products</div>
                    
                    @foreach($products as $value)
                    <div class='products-card products-card--list'>
                        <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                            <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading="lazy">
                        </a>
                        <div class='products-card__content'>
                            <div class="title">{{$value->name}}</div>
                            <div class="rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="{{route('contact-us')}}" class="fancyLink">Get A Quote</a>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class='products-card products-card--list'>
                        <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                            <img src='images/product-img-3.png' alt='image' class='imgFluid' loading="lazy">
                        </a>
                        <div class='products-card__content'>
                            <div class="title">Your Heading Goes Here</div>
                            <div class="rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                        </div>
                    </div>
                    <div class='products-card products-card--list'>
                        <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                            <img src='images/product-img-1.png' alt='image' class='imgFluid' loading="lazy">
                        </a>
                        <div class='products-card__content'>
                            <div class="title">Your Heading Goes Here</div>
                            <div class="rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                        </div>
                     </div> --}}
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class='row no-gutters '>
                    @foreach($products as $value)
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="category">{{$value->productBelongsToCategory->title}}</div>
                                <div class="title">{{$value->name}}</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="{{route('contact-us')}}" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.25s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <div class="custom-badge">SOLD OUT</div>
                                <img src='images/product-img-2.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                 <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.5s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src='images/product-img-3.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.75s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <div class="custom-badge custom-badge--red">- 6%</div>
                                <img src='images/product-img-4.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                 <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="2s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src='images/product-img-5.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src='images/product-img-1.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.25s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <div class="custom-badge">SOLD OUT</div>
                                <img src='images/product-img-2.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                 <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.5s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src='images/product-img-3.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.75s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <div class="custom-badge custom-badge--red">- 6%</div>
                                <img src='images/product-img-4.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                 <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="2s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src='images/product-img-5.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <img src='images/product-img-1.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-lg-3 wow bounceInUp' data-wow-duration="1.25s">
                        <div class='products-card products-card--up'>
                            <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                                <div class="custom-badge">SOLD OUT</div>
                                <img src='images/product-img-2.png' alt='image' class='imgFluid' loading="lazy">
                            </a>
                            <div class='products-card__content'>
                                <div class="title">Your Heading Goes Here</div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                 <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                            </div>
                        </div>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products -->
<div class='products mar-y'>
    <div class='container'>
        <div class='section-content link--heading'>
            <h5 class='heading wow zoomInLeft'>Build your cart</h5>
            <a href="#" class="fancyLink wow zoomInRight">All Products</a>
        </div>
        <div class='row no-gutters'>
        @foreach($products as $value)
            <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">{{$value->name}}</div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <a href="{{route('contact-us')}}" class="fancyLink">Get A Quote</a>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1.25s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <div class="custom-badge">SOLD OUT</div>
                        <img src='images/product-img-2.png' alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">Your Heading Goes Here</div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1.5s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <img src='images/product-img-3.png' alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">Your Heading Goes Here</div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1.75s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <div class="custom-badge custom-badge--red">- 6%</div>
                        <img src='images/product-img-4.png' alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">Your Heading Goes Here</div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="2s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <img src='images/product-img-5.png' alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">Your Heading Goes Here</div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="2.25s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <img src='images/product-img-6.png' alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">Your Heading Goes Here</div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <a href="contact-us.php" class="fancyLink">Get A Quote</a>
                    </div>
                </div>
            </div> 
              --}}
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
    var Loader = function () {
        return {
            show: function () {
                jQuery("#preloader").show();
            },
            hide: function () {
                jQuery("#preloader").hide();
            }
        };
    }();
  /*in page css here*/

    $(".filter_cate").click(function(){
        Loader.show();
        var slug = $(this).data('slug')
        if(slug === 'all'){
            window.location.replace('{{route("products")}}');
        }else{
            window.location.replace('{{route("products")}}?slug='+slug);
        }
      
    })

})()
</script>
@endsection