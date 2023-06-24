@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
  <div class="main-wrapper">
    <div class="chart-wrapper">


      <div class="user-wrapper">
        <div class="row align-items-center mc-b-3">
          <div class="col-lg-6 col-12">
            <div class="primary-heading color-dark">
              <h2>Orders Inquiry Management</h2>
            </div>
          </div>

        </div>

        <div class="table-responsive">
          <table id="user-table" class="table table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Country</th>
                <th>Sddress</th>
                <th>ZIP Code</th>
                <th>Message</th>
                <th>Produt Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Dated</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
              <?php $i = 1 ;?>
              @foreach($orders as $order)
              {{-- {{ dd($order->productsBelongsToOrder) }} --}}
              <tr>
                <td>{{$order->name??$order->fname}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->city}}</td>
                <td>{{$order->country}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->zip_code}}</td>
                <td>{{$order->message}}</td>
                <td>{{$order->productsBelongsToOrder->name}}</td>
                <td>{{$order->type}}</td>
                <td>
                  <?php $ab = $order->type."_price"; ?>
                  ${{$order->productsBelongsToOrder->new_price??$order->productsBelongsToOrder->price}}
                </td>
                <td>{{$order->quantity}}</td>
                
                <td>{{date('d-M-y',strtotime($order->created_at))}}</td>
                <td>{{$order->is_active == 1 ? 'Active' : 'Closed'}}</td>
                <td>
                  <div class="dropdown show action-dropdown">
                    <a class=" dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="action-dropdown">
                      {{-- <a class="dropdown-item" href="{{route('admin.order_detail',$order->id)}}"><i
                          class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        View</a> --}}

                      <a class="dropdown-item" href="{{route('admin.order-inquiry-delete',$order->id)}}"><i
                          class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <?php $i++;?>
              @endforeach

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  </section>

  @endsection
  @section('css')
  <style type="text/css">
    /*in page css here*/
  </style>
  @endsection
  @section('js')
  <script type="text/javascript">
    (()=>{

    $('#user-table').DataTable( {
        "order": [[ 0, "desc" ]]
    } );

  /*in page css here*/
})()
  </script>
  @endsection

