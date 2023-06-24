@extends('layouts.main')
@section('content')
<?php
$banner = App\Models\Imagetable::where('table_name','home-slider')->where('headings','checkout')->latest()->first();
?>
<!-- page-title -->
<div class="page-title">
  <div class="page-title__img">
    <img src="{{asset($banner->img_path)}}" alt="image" class="imgFluid" />
  </div>
  <div class="page-title__content">
    <h1 class="heading">Checkout</h1>
  </div>
</div>

<div class="my-cart mar-y">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="cart-conent">
                    <h2>Detail Order</h2>
                    <ul class="detail-order">
                        <li>
                            <ul class="contact__input">
                                <li><label for="">Subtotal</label></li>
                                <li><input type="text" value="${{ number_format($orders['total_amount'],2) }}"></li>
                            </ul>
                        </li>
                        <li>
                            <ul class="contact__input">
                                <li><label for="">Shipping Cost</label></li>
                                <li><input type="text" value="$0.000"></li>
                            </ul>
                        </li>
                        <li>
                            <ul class="contact__input">
                                <li><label for="">Promo Code</label></li>
                                <li><input type="text" value="INDONESIA"></li>
                            </ul>
                        </li>
                        <li>
                            <ul class="contact__input">
                                <li><label for=""> Packaging</label></li>
                                <li><input type="text" value="$50.000 "></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="contact__input">
                        <li><label for="">Total</label></li>
                        <li><input type="text" value="${{ number_format($orders['total_amount'],2) }} USD"></li>
                    </ul>
                    <div class="payment-detail">
                        <h2>Payment Detail <span>11:55:55</span></h2>
                        <p>Please make a payment according with the limit time specified, starting from now</p>
                    </div>
                </div>
            </div>
            <div class="offset-lg-1 col-lg-6">
                <div>
                    <div class="cart-conent cart-conent--bg">
                        <h2>Order Detail</h2>
                        <ul class="detail-order order-detail">
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Order Number</label></li>
                                    <li class="order-list-detail">
                                        <div><input type="text" value="MTAWEB-3A86D4DB">
                                            <span>COPY</span>
                                        </div>
                                        <div class="short-content">Always remember Order Number for easy tracking </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Purchase Date</label></li>
                                    <li class="order-list-detail">
                                        <div><input type="text" value="2019-11-07 14:01:48">
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Items</label></li>
                                    <li class="order-list-detail">
                                        <div><input type="text" value="Way Kambas Mini Ebony">
                                            <div class="short-content">2 x IDR 1.024.000 </div>
                                        </div>
                                        <div><input type="text" value="Sikka (Ebony &amp; Mapple">
                                            <div class="short-content">2 x IDR 1.024.000 </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Name</label></li>
                                    <li class="order-list-detail">
                                        <div><input type="text" value="Rasyidin Arsyad Nasution">
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Phone</label></li>
                                    <li class="order-list-detail">
                                        <div><input type="text" value="+18911188899">
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Email</label></li>
                                    <li class="order-list-detail">
                                        <div><input type="text" value="rasyid.arsyad@gmail.com">
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="contact__input">
                                    <li><label for="">Shipping Address</label></li>
                                    <li class="order-list-detail">
                                        <div>18 Richardson Drive Fountain Valley, CA 92708"
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="payment-cards">
            <h2>Payment Method</h2>
            {{-- <div class="row">
                <div class="col-lg-3">
                    <div class="payment-method">
                        <label class="card-radio">BNI Cicilan 0%
                            <input type="radio" checked="checked" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-1.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="payment-method">
                        <label class="card-radio">Mandiri Cicilan 0%
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-2.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="payment-method">
                        <label class="card-radio">Bank Transfer
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-3.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="payment-method">
                        <label class="card-radio">Credit Card
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-4.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="payment-method">
                        <label class="card-radio">Credit Card Cicilan 0% (Danamon, UOB &amp; Standard Chartered)
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-5.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="payment-method">
                        <label class="card-radio">GO-PAY
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-6.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="payment-method">
                        <label class="card-radio">Krdivo
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <img src="images/card-7.png" alt="">
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <script src="https://js.stripe.com/v3/"></script>
                <!-- Display a payment form -->
                  <form id="payment-form">
                    <div id="payment-element">
                      <!--Stripe.js injects the Payment Element-->
                    </div>
                    <button id="submit">
                      <div class="spinner hidden" id="spinner"></div>
                      <span id="button-text">Pay now</span>
                    </button>
                    <div id="payment-message" class="hidden"></div>
                  </form>
            </div>
        </div>
        <div class="payment-btn ">
            {{-- <a href="javascript:void(0)" class="themeBtn  mc-t-1" tabindex="0">Proceed Payment</a> --}}
        </div>
    </div>
</div>

<section class="container-fluid inner-Page">
    <div class="card-panel">
        <div class="media wow fadeInUp" data-wow-duration="1s">
            <div class="companyIcon">
            </div>
            <div class="media-body">

                <div class="container">
                    @if(session('success_msg'))
                    <div class="alert alert-success fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        {{ session('success_msg') }}
                    </div>
                    @endif
                    @if(session('error_msg'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        {{ session('error_msg') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>

@endsection
@section('css')
    <style>
    
        *{
            box-sizing: border-box;
        }

        form {
            align-self: center;
            box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
                0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
            border-radius: 7px;
            padding: 40px;
        }

        .hidden {
            display: none;
        }

        #payment-message {
            color: rgb(105, 115, 134);
            font-size: 16px;
            line-height: 20px;
            padding-top: 12px;
            text-align: center;
        }

        #payment-element {
            margin-bottom: 24px;
            height: 100%;
        }

        button {
            background: #5469d4;
            font-family: Arial, sans-serif;
            color: #ffffff;
            border-radius: 4px;
            border: 0;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
        }
        button:hover {
            
        }
        button:disabled {
            opacity: 0.5;
            cursor: default;
        }

        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }
        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }
        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }
        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }
        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }
        @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
                min-width: initial;
            }
        }

  </style>
@endsection
@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const items = [{ id: "xl-tshirt" }];

    let elements;

    initialize();
    checkStatus();

    document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);

    async function initialize() {
        const clientSecret  = '{{ $secret }}';
        elements = stripe.elements({ clientSecret });

        const paymentElementOptions = {
            layout: "tabs",
        };
    
        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);
    
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: "{{route('order.submit')}}?amount={{ $amount }}",
            },
        });
        
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    }

    async function checkStatus() {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!");
            break;
            case "processing":
                showMessage("Your payment is processing.");
            break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
            break;
            default:
            showMessage("Something went wrong.");
            break;
        }
    }

                
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#payment-message");
        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;
        setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
        }, 4000);
    }

    function setLoading(isLoading) {
        if (isLoading) {
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }
</script>
@endsection