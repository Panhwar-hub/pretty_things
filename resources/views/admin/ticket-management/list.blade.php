@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
      <div class="main-wrapper">
        <div class="chart-wrapper">
        
         
        <div class="value-wrapper">
          <div class="row align-items-center mc-b-3">
            <div class="col-lg-6 col-12">
              <div class="primary-heading color-dark">
                <h2> Ticket Management</h2>
              </div>
            </div>
            <!-- <div class="col-lg-6 col-12">
              <div class="text-right">
                <a href="{{route('admin.add_category')}}" class="primary-btn primary-bg">Add New</a>
              </div>
            </div> -->
          </div>

        


          <div class="table-responsive">
            <table id="user-table" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Ticket ID</th>
                  <th>Subject</th>
                  <th>Email</th>
                 

                  <th>Status</th>
              
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ;?>
                @foreach($myticket as $value)
               
                <tr>
                <td>{{$i}}</td>
                  <td>Ticket ID # {{$value->id}}</td>
                
              
                  <td>{{$value->subject}}</td>
                  <td>{{$value->email}}</td>
        
            
                  
                  <td> @if($value->is_active == 1)
                        Active  
                        @elseif($value->is_active == 0)
                        Pending
                        @else
                        Closed
                    @endif
                  </td>
                  <td>
                    <div class="dropdown show action-dropdown">
                      <a class=" dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="action-dropdown">
                      
                        <a class="dropdown-item" href="{{route('admin.viewticket',$value->id)}}"><i class="fa fa-eye"
                            aria-hidden="true"></i>
                          View</a>
                        
                        
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
  
  /*in page css here*/
  $('#user-table').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
})()
</script>
@endsection