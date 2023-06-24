@extends('layouts.main')
@section('content')
    <!-- page-title -->
    <div class="page-title">
        <div class="page-title__content">
            <h1 class="heading">Products Detail</h1>
        </div>
    </div>

    <!-- Products Detail -->
    <div class="products mar-y">
        <div class='container'>
            <div class='products-detail '>
                <div class='row'>
                    <div class="col-12 col-lg-6">
                        <div class="products-detail__singleImg product-single-slider">
                            <img src='{{ asset($product->img_path) }}' alt='image' class='imgFluid'>
                            @foreach ($product->productsHasMultiImages as $key => $value)
                                <img src='{{ asset($value->img_path) }}' alt='image' class='imgFluid'>
                            @endforeach
                        </div>
                        <ul class="products-detail__listImg product-list-slider">
                            @foreach ($product->productsHasMultiImages as $key => $value)
                                <li>
                                    <img src='{{ asset($value->img_path) }}' alt='image' class='imgFluid'>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="products-detail__content">
                            <div class="title">{{ $product->name }}</div>
                            <div class="rating">
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                            </div>
                            {{-- <a href="{{route('contact-us')}}" class="fancyLink">Get A Quote</a> --}}
                            <a href="javascript:void(0)" data-toggle="modal" class="fancyLink"
                                data-target="#order_inquiry">Get A Quote</a>

                            <?php echo html_entity_decode($product->long_desc); ?>
                            {{-- <div class="quantity mt-4">
                            <div class="quantity__title">QUANTITY</div>
                            <label class="quantity__actions">
                                <i class='bx bx-chevron-up' id="add"></i>
                                <input type="text" value="1" id="quantity">
                                <i class='bx bx-chevron-down ' id="minus"></i>
                            </label>
                        </div> --}}
                            <ul class="details">
                                <li>
                                    <b class="title">Category :</b>
                                    {{ $product->productBelongsToCategory->title }}
                                </li>
                                <li>|</li>
                                <li>
                                    <b class="title">Tags :</b>
                                    Lorem
                                </li>
                            </ul>
                            {{-- <div class="price">
                            <ins>&dollar;{{$product->new_price}}</ins>
                            <del>&dollar;{{$product->price}}</del>
                        </div> --}}

                            {{-- <form action="{{route('save-cart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="type" value="1">
                            
                            <div class="wrapper">
                                <button type="submit" class="themeBtn">Add to cart</button>
                                
                            </div>
                        </form> --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="nav products-actions" id="nav-tab" role="tablist">
                <a class="products-actions__single active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                    role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
                <a class="products-actions__single" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                    role="tab" aria-controls="nav-profile" aria-selected="false">Specification</a>
                <a class="products-actions__single" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                    role="tab" aria-controls="nav-contact" aria-selected="false">Customer Reviews (20)</a>
            </div>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade  show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="section-content">
                        <div class="heading">Description</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti eligendi vitae aliquam vel
                            dolorum. Officia repudiandae minima odio, pariatur nemo ad maxime fuga recusandae velit? Nobis
                            nam ad molestiae nulla.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti eligendi vitae aliquam vel
                            dolorum. Officia repudiandae minima odio, pariatur nemo ad maxime fuga recusandae velit? Nobis
                            nam ad molestiae nulla.</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="section-content">
                        <div class="heading">Specification</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti eligendi vitae aliquam vel
                            dolorum. Officia repudiandae minima odio, pariatur nemo ad maxime fuga recusandae velit? Nobis
                            nam ad molestiae nulla.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti eligendi vitae aliquam vel
                            dolorum. Officia repudiandae minima odio, pariatur nemo ad maxime fuga recusandae velit? Nobis
                            nam ad molestiae nulla.</p>
                    </div>
                </div>
                <div class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="reviews">
                        <?php
                        $slider = App\Models\Review::where('item_id', $product->id)
                            ->where('is_active', 1)
                            ->latest()
                            ->get();
                        ?>
                        <div class="reviewsSingleWrapper">
                            @foreach ($slider as $slid)
                            {{-- {{ dd($slid) }} --}}
                                <div class="reviews-single">
                                    <div class="reviews-single__img">
                                        <img src='{{ asset('images/person-img.png') }}' alt='image' class='imgFluid'
                                            loading='lazy'>
                                    </div>
                                    <div class="reviews-single__info">
                                        <div class="date">{{date("d M Y",strtotime($slid->created_at))}}</div>
                                        <h6 class="profile">{{ $slid->name }}</h6>
                                        <p>{{$slid->review}}</p>
                                        <div class="rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if($i < $slid->rating)
                                                <i class='bx bxs-star'></i>
                                                @else
                                                <i class='bx bxs-star white-star'></i>
                                                @endif
                                            @endfor
                                            {{-- <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form id="add-record-form" class="contact-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="section-content mb-3">
                                <div class="heading">Add a Review</div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-12 col-lg-6">
                                    <div class="contact-form__fields">
                                        <input type="text" placeholder="Enter your full name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="contact-form__fields">
                                        <input type="email" placeholder="Enter your Email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="contact-form__fields">
                                        <input type="text" name="phone" required placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="contact-form__fields">
                                        <textarea rows="6" placeholder="Leave a comment...." name="review" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="section-content">
                                        <div class="heading">Your rating</div>
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <div class="start">
                                            <div class="rate">
                                                <input type="radio" id="star5" name="rating" value="5">
                                                <label for="star5">5 stars</label>
                                                <input type="radio" id="star4" name="rating" value="4">
                                                <label for="star4">4 stars</label>
                                                <input type="radio" id="star3" name="rating" value="3">
                                                <label for="star3">3 stars</label>
                                                <input type="radio" id="star2" name="rating" value="2">
                                                <label for="star2">2 stars</label>
                                                <input type="radio" id="star1" name="rating" value="1">
                                                <label for="star1">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="contact-form__fields">
                                        <button class="themeBtn" id="add-record">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ dd($product) }} --}}
    <!-- Modal -->
    <div class="modal fade" id="order_inquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Order Inquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('order_inquiry') }}" method="POST" id="order_inquiry_form">
                        @CSRF
                        <input type="hidden" name="product_price" class="productprice"
                            value="{{ $product->new_price }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Phone</label>
                                <input type="email" class="form-control" name="phone" placeholder="Phone">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Quantity</label>
                                <input type="number" name="quantity" class="form-control input-number" value="1"
                                    min="1" max="{{ $product->new_stock }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Product Type</label>
                                <select name="select_stock" id="select_stock" class="form-control">
                                    <option value="new" selected> New </option>
                                    <option value="new_box_open"> New Box Open </option>
                                    <option value="use"> Use </option>
                                    <option value="refurbished"> Refurbished </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Shipping Address</label>
                            <input type="text" class="form-control" name="address" placeholder="1234 Main St">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">City</label>
                                <input type="text" class="form-control" name="city" placeholder="City">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="Country">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">ZIP Code</label>
                                <input type="text" class="form-control" name="zip_code" placeholder="ZIP Code">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputCity">Message</label>
                                <textarea name="message" class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary order_inquiry_form">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
        .reviewsSingleWrapper{
            height: 335px;
            overflow-y: auto;
            padding-right: 1rem;
        }
        i.bx.bxs-star.white-star {
            color: #6c757d;
        }
    /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            var Loader = function() {
                return {
                    show: function() {
                        $("#preloader").show();
                    },
                    hide: function() {
                        $("#preloader").hide();
                    }
                };
            }();
            /*in page css here*/
            $(".order_inquiry_form").click(function() {
                Loader.show();
                var data = new FormData(document.getElementById("order_inquiry_form"));


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('order_inquiry') }}',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType

                    success: function(data) {

                        Loader.hide();
                        $("#order_inquiry").modal('toggle');
                        $.toast({
                            heading: 'Inquiry Submit Success!',
                            position: 'top-right',
                            text: data.msg,
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 2500,
                            stack: 6
                        });
                        setInterval(() => {
                            location.reload();
                        }, 2050);
                    }

                });
            });

            $("#add-record").click(function(e) {
                Loader.show();
                e.preventDefault();
                var data = new FormData(document.getElementById("add-record-form"));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.create-review') }}',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function(data) {
                        Loader.hide();
                        if (data.status == 1) {
                            $.toast({
                                heading: 'Success!',
                                position: 'top-right',
                                text: data.msg,
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 2500,
                                stack: 6
                            });

                            $('#add-record-form')[0].reset();
                            setInterval(() => {

                                location.reload();
                            }, 2500);
                        }
                        if (data.status == 2) {
                            $.toast({
                                heading: 'Error!',
                                position: 'bottom-right',
                                text: data.error,
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                stack: 6
                            });
                        }
                    }
                });
            });

        })()
    </script>
@endsection
