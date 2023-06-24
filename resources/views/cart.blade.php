@extends('layouts.main')
@section('content')

<!-- page-title -->
<div class="page-title">
    <div class="page-title__content">
        <h1 class="heading">Cart</h1>
    </div>
</div>

<!-- Cart -->
@if(Session::has('cart') && !empty(Session::get('cart')))
<?php 
$cart = Session::get('cart');
$total = 0; 
?>
<div class="cart-page mar-y py-5">
    <div class="container">
        
        @foreach($cart as $k => $val)

        <?php
        if ($k == 'billing_address') {
            continue;
        }
        $product = App\Models\Products::where('id',$val['product_id'])->first();
        ?>
        <div class="bg-bottom_line">
            <div class=" row ">

                <div class="col-lg-6">
                    <div class="cart-product-thumbnail">
                        <a href="{{route('products-detail',$product['slug'])}}">
                            <figure><img src="{{asset($product['img_path'])}}" class="img-responsive" alt="cart-1"></figure>
                        </a>
                        <div class="cart-product-content">
                            <a href="{{route('products-detail',$product['slug'])}}">
                                <h4>{{$product['name']}}</h4>
                            </a>
                            <p><del>${{$val['price']}}</del></p>
                            <h5 class="color-primary" >${{$product['new_price']}} USD</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex justify-content-end">
                        <form action="#">
                            <div class="form-group main-form mc-b-3">
                                <label for="">Select Packaging</label>
                                <select name="pakage[]" id="" class="form-control">
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                </select>

                            </div>
                        </form>
                    </div>
                    <div class="num-block skin-1 d-flex cart-price ">
                        <div class="num-in">
                            <span class="minus dis changeqty" data-id="{{$product['id']}}" ></span>
                            <input name="quantity[]" type="text" class="in-num" id='qty{{$product['id']}}' name="quantity" value="{{$val['quantity']}}" readonly="">
                            <span class="plus changeqty" data-id="{{$product['id']}}"></span>
                            <input type="hidden" name="subtotal[]" id="subtotal{{$product['id']}}" value="{{$val['sub_total']}}">
                            <input type="hidden" id="newprice{{$product['id']}}" value="{{$val['price']}}">
                            <input type="hidden" name="producd_id[]" value="{{$product['id']}}" >
                        </div>
                        <h5 class="color-primary" id="subtotaltext{{$product['id']}}">${{$val['sub_total']}} USD</h5>
                        {{-- <a href="javascript:void(0)" data-id="{{ $k }}" class="cart-delete"><i class="fa fa-times"></i></a> --}}
                        <a href="javascript:void(0)" data-id="{{ $k }}" class="cart-delete color-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    
        {{-- <div class="bg-bottom_line mc-t-4">
            <div class=" row ">
                <div class="col-lg-6">
                    <div class="cart-product-thumbnail">
                        <a href="{{route('products')}}">
                            <figure><img src="images/product-img-2.png" class="img-responsive" alt="cart-1"></figure>
                        </a>
                        <div class="cart-product-content">
                            <a href="{{route('products')}}">
                                <h4>Label Printers</h4>
                            </a>
                            <p><del>$150.00</del></p>
                            <h5 class="color-primary">$9.99 USD</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex justify-content-end">
                        <form action="#">
                            <div class="form-group main-form mc-b-3">
                                <label for="">Select Packaging</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                    <option value="">Wooden Packaging ($ 50.000)</option>
                                </select>

                            </div>
                        </form>
                    </div>
                    <div class="num-block skin-1 d-flex cart-price ">
                        <div class="num-in">
                            <span class="minus dis"></span>
                            <input type="text" class="in-num" value="1" readonly="">

                            <span class="plus"></span>
                        </div>
                        <h5 class="color-primary">$9.99 USD</h5>
                        <a href="" class="cart-delete color-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>

                </div>

            </div>
        </div> --}}
        <div class="col-lg-6">

        </div>
        <div class=" mc-t-4">
            <a href="{{route('checkout')}}" class="themeBtn themeBtn--full justify-content-center">Checkout</a>
            {{-- <button type="submit" class="themeBtn themeBtn--full justify-content-center">Checkout</button> --}}
        </div>
    
    </div>

</div>

@else
<div class="cart-page mar-y py-5">
    <p>Thir is no product in cart</p>
</div>
@endif
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
    $(".changeqty").click(function(){
        var id = $(this).data('id')
        if($(this).hasClass('minus')){
            var pri = parseInt($('#newprice'+id).val())
            var qty = $("#qty"+id).val();
            var total = pri*(--qty);
            $("#qty"+id).val(parseInt(qty))
            console.log(pri +" "+ qty)
            $('#subtotal'+id).val(parseInt(total))
            $('#subtotaltext'+id).html("$ "+parseInt(total)+" UDS")
        }else if($(this).hasClass('plus')){
            var pri = parseInt($('#newprice'+id).val())
            var qty = $("#qty"+id).val();
            var total = pri*(++qty);
            $("#qty"+id).val(parseInt(qty))
            $('#subtotal'+id).val(parseInt(total))
            $('#subtotaltext'+id).html("$ "+parseInt(total)+" UDS")
        }
        var rowid = id+""+1
        var qt = qty
        if (qt <= 0) {
            qt = 1;
            $.toast({
                heading: 'Success!',
                position: 'bottom-right',
                text: 'Quantity Must be greater than 0!',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3000,
                stack: 6
            });
            return 0;
        }
        var stock = parseInt($(this).parent().parent().parent().find('.stock_qty').val()); 
        if (qt > stock) {
            $.toast({
                heading: 'Error!',
                position: 'bottom-right',
                text: 'Quantity Must be less than or equals to ' + stock,
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3000,
                stack: 6
            });
        } else {
            var token = $('meta[name="csrf-token"]').attr("content");
            var url = '{{ url('update-cart') }}';
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    id: id,
                    rowid: rowid,
                    qty: qt,
                    _token: token
                },
                success: function() {
                    $.toast({
                        heading: 'Success!',
                        position: 'bottom-right',
                        text: 'Quantity Updated',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 2000,
                        stack: 6
                    });
                    setInterval(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

    })

    $(".justify-content-center").click(function(){
        $("#checkout_form").submit();
    })
    
    $('.cart-delete').click(function () {
        var id = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr("content");
        var url = '{{ url('remove-cart') }}';
        $.ajax({
            url: url,
            type: 'post',
            data: {rowid: id, _token: token},
            success: function () {
                $.toast({
                    heading: 'Success!',
                    position: 'bottom-right',
                    text:  'Item removed!',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
                setInterval(() => {
                    location.reload();
                }, 2000);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    

})()
</script>
@endsection