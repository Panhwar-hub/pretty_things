@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
    <div class="main-wrapper">
        <div class="chart-wrapper">
            <div class="user-wrapper">
                <div class="invoice">
                    <div class="invoice__header">
                        <img class="invoice__logo" src="{{asset(isset($logo) ? $logo->img_path : 'images/logo.png')}}"
                            alt="">
                    </div>
                    <div class="invoice_heading">
                        <h1>Details</h1>
                    </div>
                    <div class="row invoice__address">
                        <div class="col-6">
                            <div class="text-right">
                                <p><b>Name</b></p>
                                <p><b>Email</b></p>
                                <p><b>Quantity</b></p>
                                <p><b>Type</b></p>
                                <p><b>City</b></p>
                                <p><b>Country</b></p>
                                <p><b>Shipping Address</b></p>
                                <p><b>ZIP Code</b></p>
                                <p><b>Message</b></p>
                                <p><b>Created At</b></p>
                                
                                <h4>Product Detail</h4>
                                
                                <p><b>Name</b></p>
                                <p><b>Type</b></p>
                                <p><b>Price</b></p>
                                <p><b>Flat Shipping Rate</b></p>
                                <p><b>Stock</b></p>
                                <p><b>Width</b></p>
                                <p><b>height</b></p>
                                <p><b>Weight</b></p>
                                <p><b>Length</b></p>
                                <p><b>Product Link</b></p>
                                <p><b>Image</b></p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-left">

                                <p>{{$order_inquiry->name}}</p>
                                <p>{{$order_inquiry->email}}</p>
                                <p> {{$order_inquiry->quantity}}</p>
                                <p> {{$order_inquiry->type}}</p>
                                <p> {{$order_inquiry->city}}</p>
                                <p>{{$order_inquiry->country}}</p>
                                <p>{{$order_inquiry->address}}</p>
                                <p>{{$order_inquiry->zip_code}}</p>
                                <p>{{$order_inquiry->message}}</p>
                                <p>{{$order_inquiry->created_at}}</p>
                                <h4>--</h4>
                                <p>{{$order_inquiry->productsBelongsToOrder->name}}</p>
                                <p>{{$order_inquiry->type}}</p>
                                <?php
                                    $pri = $order_inquiry->type."_price";
                                    $stock = $order_inquiry->type."_price";
                                ?>
                                <p>{{$order_inquiry->productsBelongsToOrder->$pri}}</p>
                                <p>{{$order_inquiry->productsBelongsToOrder->flat_shipping_rate}}</p>
                                <p>{{$order_inquiry->productsBelongsToOrder->$stock}}</p>
                                <p>{{$order_inquiry->productsBelongsToOrder->width}}</p>
                                <p>{{$order_inquiry->productsBelongsToOrder->height}}</p>
                                <p>{{$order_inquiry->productsBelongsToOrder->weight}}</p>
                                <p>{{$order_inquiry->productsBelongsToOrder->length}}</p>
                                <p><a href="{{route('product-detail',$order_inquiry->productsBelongsToOrder->slug)}}"> {{$order_inquiry->productsBelongsToOrder->name}} </a>
                                <p><img src="{{asset($order_inquiry->productsBelongsToOrder->img_path)}}" width="100px" /></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-6">
                                <form action="{{route('generate_payable_link')}}" method="POST">
                                    @CSRF
                                    <input type="hidden" name="order_inquiry_id" value="{{$order_inquiry->id}}">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Product Whole Sale Price</label>
                                            <input type="text" class="form-control" name="whole_sale_price" placeholder="Product Whole Sale Price">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Shipping Price</label>
                                            <input type="email" class="form-control" name="shipping_price" placeholder="Shipping Price">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Discount in Percentage</label>
                                            <input type="number" name="discount_percentage" class="form-control input-number" placeholder="Discount in Percentage">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Discount on</label>
                                            <select name="discount_on" id="discount_on" class="form-control">
                                                <option value="product"> Product </option>
                                                <option value="shipping"> Shipping </option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Generate Payable Link</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('hcss')
<!-- <link rel="stylesheet" href="{{asset('css/demo.css')}}"> -->
@endsection
@section('css')
<style>
    /* .sidebar {
        width: 270px;
        position: fixed;
        left: 0;
        padding: 102px 2rem .5rem;
        height: 100%;
        overflow: hidden;
        z-index: 19;
        background: #f5f5f5;
    } */
    section.content {
        overflow-y: auto;
        overflow-x: hidden;
    }

    .invoice {
        min-width: auto;
    }
    .row.invoice__address p {
        margin-bottom: 10px;
    }

    .table thead th,
    .table-bordered,
    .table-bordered td,
    .table-bordered th {
        border-bottom: 1px solid #9c9ea6;
    }

    .table-bordered,
    .table-bordered td,
    .table-bordered th {
        border: 1px solid #9c9ea6;
    }

    .invoice_heading {
        text-align: center;
        margin: 25px auto;
        width: 25%;
        border: 2px solid black;
        margin-top: 0px;
        /* border-radius: 25px; */
    }

    table.table-bordered.dataTable tbody th,
    table.table-bordered.dataTable tbody td {
        border-bottom-width: 1 !important;
    }
</style>
@endsection