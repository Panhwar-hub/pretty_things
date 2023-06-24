@extends('layouts.main')
@section('content')

<!-- Banner -->
<!-- Banner -->
<div class="bannerSlider">
    @foreach ($banner1 as $val)
        <div class="banner">
            <img src="{{asset($val->img_path)}}" alt='image' class='imgFluid banner__overlay' loading='lazy '>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 wow zoomInLeft">
                        <div class="banner-content">
                            <h1 class="banner-content__heading">{{$val->headings}}</h1>
                            <p>{{$val->description}}</p>
                            <?php //App\Helpers\Helper::inlineEditable("h1",["class"=>"banner-content__heading"],'Selling only the best things online','WELCOMESLIDERHEAD1');?>
                            <?php //App\Helpers\Helper::inlineEditable("p",["class"=>""],'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.','WELCOMESLIDERTXT1');?>
                            <a href="{{route('products')}}" class="themeBtn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="banner">
        <img src="{{asset('images/banner-overlay.png')}}" alt='image' class='imgFluid banner__overlay' loading='lazy '>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 wow zoomInLeft">
                    <div class="banner-content">
                        <?php App\Helpers\Helper::inlineEditable("h1",["class"=>"banner-content__heading"],'Selling only the best things online','WELCOMESLIDERHEAD2');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.','WELCOMESLIDERTXT2');?>
                        <a href="{{route('products')}}" class="themeBtn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <img src="{{asset('images/banner-overlay.png')}}" alt='image' class='imgFluid banner__overlay' loading='lazy '>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 wow zoomInLeft">
                    <div class="banner-content">
                    <?php App\Helpers\Helper::inlineEditable("h1",["class"=>"banner-content__heading"],'Selling only the best things online','WELCOMESLIDERHEAD3');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.','WELCOMESLIDERTXT3');?>
                        <a href="{{route('products')}}" class="themeBtn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <img src="{{asset('images/banner-overlay.png')}}" alt='image' class='imgFluid banner__overlay' loading='lazy '>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 wow zoomInLeft">
                    <div class="banner-content">
                        <?php App\Helpers\Helper::inlineEditable("h1",["class"=>"banner-content__heading"],'Selling only the best things online','WELCOMESLIDERHEAD4');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.','WELCOMESLIDERTXT4');?>
                        <a href="{{route('products')}}" class="themeBtn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<!-- Categories -->
<div class='categories mar-y'>
    <div class='container'>
        <div class='section-content link--heading'>
            <?php App\Helpers\Helper::inlineEditable("h2",["class"=>"heading wow zoomInLeft"],'Popular Categories','POPULARCCATEGORY');?>
            <a href="#" class="fancyLink wow zoomInRight">View All Categories</a>
        </div>
        <ul class="categories-list">
            
            @foreach($category as $key => $value)
            <li class="categories-list__single wow zoomIn" data-wow-duration="1s">
                <a href="{{route('products', 'slug='.$value->slug)}}">
                    <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">{{$value->title}}</div>
                </a>
            </li>
            @endforeach
            {{-- <li class="categories-list__single wow zoomIn" data-wow-duration="1.25s">
                <a href="#">
                    <img src="{{asset('images/categories-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart watch</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="1.5s">
                <a href="#">
                    <img src="{{asset('images/categories-img-3.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">shoes</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="1.75s">
                <a href="#">
                    <img src="{{asset('images/categories-img-4.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart Droon</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="2s">
                <a href="#">
                    <img src="{{asset('images/categories-img-5.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart selfie stick</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="2.25s">
                <a href="#">
                    <img src="{{asset('images/categories-img-6.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart teach gatet</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="2.5s">
                <a href="#">
                    <img src="{{asset('images/categories-img-7.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart shoes</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="2.75s">
                <a href="#">
                    <img src="{{asset('images/categories-img-8.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">school bag</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="3s">
                <a href="#">
                    <img src="{{asset('images/categories-img-9.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart bag</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="3.25s">
                <a href="#">
                    <img src="{{asset('images/categories-img-10.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">sport shoes</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="2.5s">
                <a href="#">
                    <img src="{{asset('images/categories-img-11.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart bag</div>
                </a>
            </li>
            <li class="categories-list__single wow zoomIn" data-wow-duration="2.75s">
                <a href="#">
                    <img src="{{asset('images/categories-img-12.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="title">smart mobile</div>
                </a>
            </li> --}}
        </ul>
    </div>
</div>

<!-- Deals -->
<div class='deals mar-y'>
    <div class='container'>
        <div class='section-content link--heading'>
            <?php App\Helpers\Helper::inlineEditable("h3",["class"=>"heading wow zoomInLeft"],'today’s best deals','BESTDEAL');?>
            <a href="#" class="fancyLink wow zoomInRight">View All</a>
        </div>
        <div class='row'>
            <div class='col-12 col-lg-8 wow bounceInLeft'>
                <div class='deals-card'>
                    <div class="row align-items-center no-gutters">
                        <div class="col-12 col-lg-2">
                            <ul class="deals-card__gallery dealsGallery">
                                <li>
                                    <img src="{{asset('images/item-img-1.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </li>
                                <li>
                                    <img src="{{asset('images/item-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </li>
                                <li>
                                    <img src="{{asset('images/item-img-3.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </li>
                                <li>
                                    <img src="{{asset('images/item-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-10 dealsSingle">
                            <div class="wrapper">
                                <div class="deals-card__single">
                                    <img src="{{asset('images/item-img-1.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </div>
                                <div class="deals-card__content">
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"subHeading"],'SMART HEALTH WATCH','SMARTPRODUCT1');?>
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"heading"],'All Natural Italian-Style samsung galaxy','SMARTPRODUCT2');?>
                                    <div class="ratingWrapper">
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <div class="total review">1 review</div>
                                    </div>
                                 
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="deals-card__single">
                                    <img src="{{asset('images/item-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </div>
                                <div class="deals-card__content">
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"subHeading"],'SMART HEALTH WATCH','SMARTPRODUCT3');?>
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"heading"],'All Natural Italian-Style samsung galaxy','SMARTPRODUCT4');?>
                                    <div class="ratingWrapper">
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <div class="total review">1 review</div>
                                    </div>
                                 
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="deals-card__single">
                                    <img src="{{asset('images/item-img-3.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </div>
                                <div class="deals-card__content">
                                <?php App\Helpers\Helper::inlineEditable("div",["class"=>"subHeading"],'SMART HEALTH WATCH','SMARTPRODUCT5');?>
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"heading"],'All Natural Italian-Style samsung galaxy','SMARTPRODUCT5');?>
                                    <div class="ratingWrapper">
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <div class="total review">1 review</div>
                                    </div>
                                 
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="deals-card__single">
                                    <img src="{{asset('images/item-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
                                </div>
                                <div class="deals-card__content">
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"subHeading"],'SMART HEALTH WATCH','SMARTPRODUCT7');?>
                                    <?php App\Helpers\Helper::inlineEditable("div",["class"=>"heading"],'All Natural Italian-Style samsung galaxy','SMARTPRODUCT8');?>
                                    <div class="ratingWrapper">
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <div class="total review">1 review</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-4 wow bounceInRight'>
                <?php $best_deal = App\Models\Products::where('best_deal', 1)->latest()->take(2)->get(); ?>
                
                @foreach ($best_deal as $deal)
                <div class='products-card products-card--list'>
                    <a href="{{route('products-detail',$deal->slug)}}" class='products-card__img'>
                    {{-- <div class="custom-badge custom-badge--red">SALE</div> --}}
                        <img src="{{asset($deal->img_path)}}" alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <div class="title title--lg">{{$deal->name}}</div>
                        
                    </div>
                </div>
                @endforeach
                {{-- <div class='products-card products-card--list'>
                    <a href="products-detail')}}" class='products-card__img'>
                        <img src="{{asset('images/product-img-2.png')}}" alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <div class="title title--lg">Your Heading Goes Here</div>
                       
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Items -->
<div class='items mar-y'>
    <div class='container'>
        <div class='section-content link--heading'>
            <?php App\Helpers\Helper::inlineEditable("h4",["class"=>"heading wow zoomInLeft"],'Consumer Items','CONSUMERITEM');?>
            <a href="#" class="fancyLink wow zoomInRight">Go to daily deals section</a>
        </div>
        <div class='row'>
            <div class='col-12 col-lg-6 wow bounceInRight'>
                <div class='items-single'>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <div class="items-single__content">
                                <div class="title">FOR MEN ONLINE</div>
                                <p>Lorem Ipsum</p>
                                <a href="{{route('contact-us')}}" class="themeBtn themeBtn--outline">Get A Quote</a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="items-single__img">
                                <img src="{{asset('images/item-single.png')}}" alt='image' class='imgFluid' loading='lazy'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-6 wow bounceInLeft'>
                <ul class="items-list">
                    <?php $cat_item = App\Models\Category::where('is_active', 1)->with('categoryHasProducts')->latest()->take(6)->get(); ?>
                    @foreach($cat_item as $value)
                    <?php
                        $pro = App\Models\Products::where('category_id', $value->id)->get();
                        $caount = $pro->count(); 
                    ?>
                    <li class="items-list__single">
                        <a href="{{route('products', 'slug='.$value->slug)}}">
                            <div class="title">{{$value->title}} </div>
                            <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading='lazy'>
                            <div class="total">{{$caount}} Items</div>
                        </a>
                    </li>
                    @endforeach
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">smart phone </div>-->
                    <!--        <img src="{{asset('images/item-img-5.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">smart watch</div>-->
                    <!--        <img src="{{asset('images/item-img-6.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">smart selfie stick </div>-->
                    <!--        <img src="{{asset('images/item-img-7.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">smart shoes </div>-->
                    <!--        <img src="{{asset('images/item-img-8.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">smart GLASSES </div>-->
                    <!--        <img src="{{asset('images/item-img-9.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Products -->
<div class='products mar-y'>
    <div class='container'>
        <div class='section-content link--heading'>
            <?php App\Helpers\Helper::inlineEditable("h5",["class"=>"heading wow zoomInLeft"],'top 20 best seller','TOPSELLER');?>

            <a href="{{route('products')}}" class="fancyLink wow zoomInRight">Go to daily deals section</a>
        </div>
        <div class='row no-gutters'>
            <?php $pro = App\Models\Products::where('best_seller', 1)->latest()->take(6)->get(); ?>
            @foreach($pro as $value)
            <div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1s">
                <div class='products-card products-card--up'>
                    <a href="{{route('products-detail',$value->slug)}}" class='products-card__img'>
                        <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading="lazy">
                    </a>
                    <div class='products-card__content'>
                        <div class="title">{{$value->title}}</div>
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
            
            <!--<div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1.25s">-->
            <!--    <div class='products-card products-card--up'>-->
            <!--        <a href="{{route('products')}}" class='products-card__img'>-->
            <!--            <div class="custom-badge">SOLD OUT</div>-->
            <!--            <img src="{{asset('images/product-img-2.png')}}" alt='image' class='imgFluid' loading="lazy">-->
            <!--        </a>-->
            <!--        <div class='products-card__content'>-->
            <!--            <div class="title">Your Heading Goes Here</div>-->
            <!--            <div class="rating">-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--            </div>-->
            <!--          <a href="{{route('contact-us')}}" class="fancyLink">Get A Quote</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1.5s">-->
            <!--    <div class='products-card products-card--up'>-->
            <!--        <a href="products-detail')}}" class='products-card__img'>-->
            <!--            <img src="{{asset('images/product-img-3.png')}}" alt='image' class='imgFluid' loading="lazy">-->
            <!--        </a>-->
            <!--        <div class='products-card__content'>-->
            <!--            <div class="title">Your Heading Goes Here</div>-->
            <!--            <div class="rating">-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--            </div>-->
            <!--           <a href="contact-us')}}" class="fancyLink">Get A Quote</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="1.75s">-->
            <!--    <div class='products-card products-card--up'>-->
            <!--        <a href="products-detail')}}" class='products-card__img'>-->
            <!--            <div class="custom-badge custom-badge--red">- 6%</div>-->
            <!--            <img src="{{asset('images/product-img-4.png')}}" alt='image' class='imgFluid' loading="lazy">-->
            <!--        </a>-->
            <!--        <div class='products-card__content'>-->
            <!--            <div class="title">Your Heading Goes Here</div>-->
            <!--            <div class="rating">-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--            </div>-->
            <!--          <a href="contact-us')}}" class="fancyLink">Get A Quote</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="2s">-->
            <!--    <div class='products-card products-card--up'>-->
            <!--        <a href="products-detail')}}" class='products-card__img'>-->
            <!--            <img src="{{asset('images/product-img-5.png')}}" alt='image' class='imgFluid' loading="lazy">-->
            <!--        </a>-->
            <!--        <div class='products-card__content'>-->
            <!--            <div class="title">Your Heading Goes Here</div>-->
            <!--            <div class="rating">-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--            </div>-->
            <!--           <a href="contact-us')}}" class="fancyLink">Get A Quote</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class='col-12 col-lg-2 wow bounceInUp' data-wow-duration="2.25s">-->
            <!--    <div class='products-card products-card--up'>-->
            <!--        <a href="products-detail')}}" class='products-card__img'>-->
            <!--            <img src="{{asset('images/product-img-6.png')}}" alt='image' class='imgFluid' loading="lazy">-->
            <!--        </a>-->
            <!--        <div class='products-card__content'>-->
            <!--            <div class="title">Your Heading Goes Here</div>-->
            <!--            <div class="rating">-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--                <i class='bx bxs-star'></i>-->
            <!--            </div>-->
            <!--           <a href="contact-us')}}" class="fancyLink">Get A Quote</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</div>

<!-- Items -->
<div class='items mar-y'>
    <div class='container'>
        <div class='section-content link--heading'>
            <?php App\Helpers\Helper::inlineEditable("h6",["class"=>"heading wow zoomInLeft"],'Just for you','JUSTFORYOU');?>
            <a href="#" class="fancyLink wow zoomInRight">Go to daily deals section</a>
        </div>
        <div class='row'>
            <div class='col-12 col-lg-6 wow bounceInRight'>
                <div class='items-single'>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <div class="items-single__content">
                                <div class="title">FOR MEN ONLINE</div>
                                <p>FOR WOMEN</p>
                                <a href="contact-us')}}" class="themeBtn themeBtn--outline">Get A Quote</a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="items-single__img">
                                <img src="{{asset('images/item-single-1.png')}}" alt='image' class='imgFluid' loading='lazy'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-6 wow bounceInLeft'>
                <ul class="items-list">
                    <?php $cat_item = App\Models\Category::where('is_active', 1)->with('categoryHasProducts')->take(6)->get(); ?>
                    @foreach($cat_item as $value)
                    <?php
                        $pro = App\Models\Products::where('category_id', $value->id)->get();
                        $caount = $pro->count(); 
                    ?>
                    <li class="items-list__single">
                        <a href="#">
                            <div class="title">{{$value->title}} </div>
                            <img src="{{asset($value->img_path)}}" alt='image' class='imgFluid' loading='lazy'>
                            <div class="total">{{$caount}} Items</div>
                        </a>
                    </li>
                    @endforeach
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">Heading Here</div>-->
                    <!--        <img src="{{asset('images/item-img-11.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">Heading Here</div>-->
                    <!--        <img src="{{asset('images/item-img-12.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">Heading Here</div>-->
                    <!--        <img src="{{asset('images/item-img-13.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">Heading Here</div>-->
                    <!--        <img src="{{asset('images/item-img-14.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="items-list__single">-->
                    <!--    <a href="#">-->
                    <!--        <div class="title">Heading Here</div>-->
                    <!--        <img src="{{asset('images/item-img-15.png')}}" alt='image' class='imgFluid' loading='lazy'>-->
                    <!--        <div class="total">3 Items</div>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Sale -->
<div class="sale wow zoomInUp">
    <div class="container">
        <div class="saleWrapper">
            <div class="sale__img">
                <img src="{{asset('images/sale-img-1.png')}}" alt='image' class='imgFluid' loading='lazy'>
            </div>
            <div class="titleWrapper">
                <?php App\Helpers\Helper::inlineEditable("div",["class"=>"sale__title"],"pecial Promo <span>Weekends Sale</span>",'PROMO1');?>
                <?php App\Helpers\Helper::inlineEditable("div",["class"=>"sale__offer"],"UP TO 50% OFF",'PROMO2');?>
            </div>
            <div class="sale__img sale__img--lg">
                <img src="{{asset('images/sale-img-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
            </div>
        </div>
    </div>
</div>

<!-- News -->
<div class='news mar-y'>
    <div class='container'>
        <div class='section-content wow zoomInUp'>
            <div class='heading'>Our News</div>
        </div>
        <div class='row'>
            <div class='col-12 col-lg-4 wow zoomInRight'>
                <div class='news-card card-hover'>
                    <div class='news-card__img card-hover__img'>
                        <img src="{{asset('images/news-img-1.png')}}" alt='image' class='imgFluid' loading="lazy">
                    </div>
                    <div class='news-card__content'>
                        <div class="info">
                            <span>By Admin</span>
                            <span>2 Comments</span>
                        </div>
                        <?php App\Helpers\Helper::inlineEditable("div",["class"=>"title"],"Heading Here",'OURNEWSH1');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.",'OURNEWSH1');?>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-4 wow zoomInUp'>
                <div class='news-card card-hover'>
                    <div class='news-card__img card-hover__img'>
                        <img src="{{asset('images/news-img-2.png')}}" alt='image' class='imgFluid' loading="lazy">
                    </div>
                    <div class='news-card__content'>
                        <div class="info">
                            <span>By Admin</span>
                            <span>2 Comments</span>
                        </div>
                        <?php App\Helpers\Helper::inlineEditable("div",["class"=>"title"],"Heading Here",'OURNEWSH2');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.",'OURNEWSH2');?>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-4 wow zoomInLeft'>
                <div class='news-card card-hover'>
                    <div class='news-card__img card-hover__img'>
                        <img src="{{asset('images/news-img-3.png')}}" alt='image' class='imgFluid' loading="lazy">
                    </div>
                    <div class='news-card__content'>
                        <div class="info">
                            <span>By Admin</span>
                            <span>2 Comments</span>
                        </div>
                        <?php App\Helpers\Helper::inlineEditable("div",["class"=>"title"],"Heading Here",'OURNEWSH3');?>
                        <?php App\Helpers\Helper::inlineEditable("p",["class"=>""],"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.",'OURNEWSH3');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Perks -->
<div class="perksWrapper">
    <div class="container">
        <div class="perks">
            <ul class="perks-list">
                <li class="perks-list__single wow bounceInRight" data-wow-duration="1s">
                    <div class="icon">
                        <img src="{{asset('images/perks-icon-1.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="info">
                        <div class="title">Free Shipping</div>
                        <p>Free Shipping for orders over £130.</p>
                    </div>
                </li>
                <li class="perks-list__single wow bounceInRight" data-wow-duration="1.25s">
                    <div class="icon">
                        <img src="{{asset('images/perks-icon-2.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="info">
                        <div class="title">Money Guarantee</div>
                        <p>Within 30 days for an exchange.</p>
                    </div>
                </li>
                <li class="perks-list__single wow bounceInRight" data-wow-duration="1.5s">
                    <div class="icon">
                        <img src="{{asset('images/perks-icon-3.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="info">
                        <div class="title">Online Support</div>
                        <p>Within 30 days for an exchange</p>
                    </div>
                </li>
                <li class="perks-list__single wow bounceInRight" data-wow-duration="1.75s">
                    <div class="icon">
                        <img src="{{asset('images/perks-icon-4.png')}}" alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="info">
                        <div class="title">Flexible Payment</div>
                        <p>Pay with Multiple Credit Cards.</p>
                    </div>
                </li>
            </ul>
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