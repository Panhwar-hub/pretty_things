@extends('userdash.layouts.dashboard.main')

@section('content')
  <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-visit-sec">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="visit-thumbnail visit-thumbnail-first mc-b-3">
                            <div class="visit-content">
                               <h3>My Orders</h3>
                            
                            </div>
                           <a href="{{route('dashboard.myBookings')}}"> <figure class="mb-0">
                                <span><i class="fa fa-sticky-note-o"></i></span>
                            </figure>
                             </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="visit-thumbnail mc-b-3">
                            <div class="visit-content">
                                <h3>My Tickets</h3>
                             
                            </div>
                            <a href="{{ route('dashboard.mytickets') }}"><figure class="mb-0">
                                <span><i class="fa fa-sticky-note-o"></i></span>
                            </figure>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
           
            
        </div>
    </section>

    <!-- DASHBOARD END -->

    <!-- APPOINTMENT-MODAL START -->

    

    <!-- APPOINTMENT-MODAL END -->

    <!-- PET-ADD-MODAL START -->

   
    <!-- PET-ADD-MODAL END -->
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
 function readURL(input) {
        if (input.files && input.files[0]) {
           // console.log('sad');
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#logo_img_my')
                    .attr('src', e.target.result);
                    console.log(e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
(()=>{
    
//     var dateObject = null;
//     $("#datepicker").datepicker({
//     onSelect: function(dateText, inst) { 
       
//         var today = new Date();
//             today = Date.parse(today.getMonth()+1+'/'+today.getDate()+'/'+today.getFullYear());
//            // console.log('today' + today);
//             //Get the selected date (also at midnight)
//             var selDate = Date.parse(dateText);
//            // console.log('today' + selDate);
//             if(selDate < today) {
//                 //If the selected date was before today, continue to show the datepicker
//                  $.toast({
// 						heading: 'Error!',
// 						position: 'bottom-right',
// 						text:  'Cannot Select A Date Before Today',
// 						loaderBg: '#ff6849',
// 						icon: 'error',
// 						hideAfter: 4000,
// 						stack: 6
// 					});
// 					dateObject = null;
//                 $('#datepicker').val('');
//                 $(inst).datepicker('show');
//                 //dateObject = null;
//             }
//             else{
//                    dateObject = $(this).datepicker('getDate'); 
//             console.log(dateObject);
//             }
            
           
//     }
// });

    

// $('#book-apt-btn').click(function(){
//     if(dateObject != null)
//     {
//    console.log(dateObject); 
//     }
//    else{
       
   
//     $.toast({
// 						heading: 'Error!',
// 						position: 'bottom-right',
// 						text:  'Please Select A Date For Booking!',
// 						loaderBg: '#ff6849',
// 						icon: 'error',
// 						hideAfter: 4000,
// 						stack: 6
// 					});
//    }
   
// });

// $('#datepicker').datepicker({ minDate: 0 });

    //  $('#Date').datepicker({
    //     onSelect: function(dateText, inst) {
    //         //Get today's date at midnight
    //         var today = new Date();
    //         today = Date.parse(today.getMonth()+1+'/'+today.getDate()+'/'+today.getFullYear());
    //         //Get the selected date (also at midnight)
    //         var selDate = Date.parse(dateText);

    //         if(selDate < today) {
    //             //If the selected date was before today, continue to show the datepicker
    //             $('#Date').val('');
    //             $(inst).datepicker('show');
    //         }
    //     }
    // });
  /*in page css here*/
})()
</script>
@endsection
