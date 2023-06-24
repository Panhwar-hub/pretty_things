@extends('layouts.main')
@section('content')
<?php
$banner = App\Models\Imagetable::where('table_name','home-slider')->where('headings','checkout')->latest()->first();
?>
<!-- page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">Check Out</h1>
    </div>
</div>
<section class="checkout-sec">
    <div class="container">
        <form method="POST" action="{{route('stripe.post')}}">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="checkout-form ">
                        <h3 class="mc-b-2">Billing Detail</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-1">
                                    <label for="">First Name <span> *</span></label>
                                    <input type="text" name="fname" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-1">
                                    <label for="">Last Name <span> *</span></label>
                                    <input type="text" name="lname" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-1">
                                    <label for="">Country <span> *</span></label>
                                    <input type="text" name="country" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-1">
                                    <label for="">Address <span> *</span></label>
                                    <input type="text" name="address" required class="form-control"
                                        placeholder="Street Address Apartment. suite, unit etc">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-1">
                                    <label for="">Town/City <span> *</span></label>
                                    <input type="text" name="town" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-1">
                                    <label for="">Country/State <span> *</span></label>
                                    <input type="text" name="state" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-1">
                                    <label for="">Postcode/Zip <span> *</span></label>
                                    <input type="text" name="zip" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-1">
                                    <label for="">Phone <span> *</span></label>
                                    <input type="text" name="phone" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-1">
                                    <label for="">Email <span> *</span></label>
                                    <input type="email" name="email" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-1">
                                    <label for="">Order Notes <span> *</span></label>
                                    <input type="text" name="note" class="form-control"
                                        placeholder="Note about your order, e.g, special noe for delivery">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkout-order">
                     
                        <div class="offset-lg-1 col-lg-12">
                            <div>
                                <div class="checkout__orderOverview">
                                    <h4>Order Detail</h4>
                                    <div>
                                        <h4>Items</h4>
                                    </div>
                                    <?php $num =01; $total =0;?>
                                    @foreach($cart_data as $key => $value)
                                        <?php
                                        if(isset($value['product_id'])){
                                            $product = App\Models\Products::where('id',$value['product_id'])->first();
                                        }else{
                                            continue;
                                        }
                                        ?>
                                        <div>
                                            <span>{{ucfirst($product['name'])}}</span>
                                            <span>
                                                {{ $value['quantity'] }} x ${{$product['new_price'] }} <b>( ${{$value['sub_total']}} )</b>
                                            </span>
                                        </div>
                                        <?php
                                            $total += $value['sub_total'];
                                            $num++;
                                            ?>
                                        @endforeach
                                    <hr>
                                    <div>
                                        <span>Shipping</span>
                                        <span>$0.00</span>
                                    </div>
                                    <div class="checkout__orderOverviewTotal">
                                        <span>Total</span>
                                        <span>${{ number_format($total, 2) }}</span>
                                        <input type="hidden" name="total_amount" value="{{$total}}">
                                    </div>
                                </div>
                                <?php 
                                    $uns=$cart_data;
                                    unset($uns['billing_address']);
                                    $ser=serialize($uns);
                                    Session::put('ser',$ser);
                                    ?>

                                <button  type="submit" class="themeBtn themeBtn--full ">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
@section('css')
<style type="text/css">
    /*in page css here*/
    .checkout__orderOverview {
        border: 1px solid #00000020;
        box-shadow: 0px 0px 10px 1px #00000020;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .checkout__orderOverview>h4 {
        margin-bottom: 1rem;
    }

    .checkout__orderOverview>div {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 1rem 0px;
    }

    .checkout__orderOverview>div:not(.checkout__orderOverviewTotal)>span {
        font-size: 16px;
    }

    .checkout__orderOverviewTotal {
        font-size: 20px;
        font-weight: 700;
        border-top: 1px solid #00000020;
        padding: 1rem 0px 0px;
    }
</style>
@endsection
@section('js')
<script type="text/javascript">
    (()=>{
        /*in page css here*/
    })()
</script>
@endsection