@extends('userdash.layouts.dashboard.main')

@section('content')
 <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-booking-sec">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="primary-heading color-dark">
                            <h2>My Tickets</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="text-lg-right text-md-right">
                           <a href="{{route('dashboard.addtickets')}}" class="primary-btn primary-bg mc-r-2">Create Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm dashboard-table">
                    <table class="table" id="data-table">
                        <thead>
                            <tr>
                            <th>Tickect ID</th>
                  
                  <th>Subject</th>
                 
                  <th>Email</th>
          
                  <th>Status</th>
            
                
                
                 
                  
               
                  <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1 ;?>
                @foreach($mytickets as $myticket)
              
                <tr>
                  <td>Ticket ID  # {{$myticket->id}}</td>

                  <td>{{$myticket->subject}}</td>
                
                  <td>{{$myticket->email}}</td>
             
                 
                  <td>
                    @if($myticket->is_active == 1)
                        Active  
                        @elseif($myticket->is_active == 0)
                        Pending
                        @else
                        Closed
                    @endif
                  </td>
                  
                  
                  
                
                  
         
                  <td>
                    <div class="dropdown show action-dropdown">
                    <?php $decrypt = Crypt::encryptString($myticket->id);?>
                      <a class=" dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="action-dropdown">
                      <a class="dropdown-item" href="{{route('dashboard.viewticket',$decrypt)}}"><i class="fa fa-eye"
                                            aria-hidden="true"></i>
                                        View</a>
                      
                        <a class="dropdown-item" href="{{route('dashboard.deleteAppointment',$decrypt)}}" onclick="return confirm('Are you sure?')"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
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
    </section>

    <!-- DASHBOARD END -->
@endsection
@section('css')
<style type="text/css">
  /*in page css here*/
   .ui-state-active{
      background: #212529 !important;
      color: #f8f9fa !important;
  }
</style>
@endsection
@section('js')
<script type="text/javascript">

(()=>{
    
    $('#data-table').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
})()
</script>
@endsection
