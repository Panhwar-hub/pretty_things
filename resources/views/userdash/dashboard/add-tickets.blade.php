@extends('userdash.layouts.dashboard.main')

@section('content')
 <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-form-sec">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Create Ticket</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="text-md-right">
                            <a href="{{route('dashboard.editProfile')}}" class="primary-btn primary-bg mc-r-2"><i class="fa fa-pencil"></i> Edit Profile</a>
                       
                        </div>
                    </div>
                </div>
                <form id="ticket-form"   class="main-form">
                        	@csrf	
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="profile-img">
                               
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-book"></i>Subject<span>*</span></label>
                               <input type="text" name="subject" required class="form-control" value="{{old('subject')}}" >
                            </div>
                        </div>
                       
                            <?php
                            $user = Auth::user();?>
                            
                            <input type="hidden" name="user_id"  class="form-control" value="{{$user->id}}" >
                             <input type="hidden" name="email"  class="form-control" value="{{$user->email}}" >
                          
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-pencil"></i> Comments <span>*</span></label>
                      
                               <textarea name="message" required class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label> File Upload </label>
                      <input type="file" name="file" id="">
                           
                            </div>
                        </div>
                        <div class="text-lg-right text-md-right">
                        <button type="button" class="primary-btn primary-bg add-pets-submit">Submit</button>
                    
                    </div>
                </form>
                        
                       
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- DASHBOARD END -->
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

  
  $('.add-pets-submit').click(function(e){
        e.preventDefault();
        
   
        
        var data = new FormData(document.getElementById("ticket-form"));
    
      
          var url = '{{ route('dashboard.createtickets') }}';


                $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                    $.ajax({

                            type: "POST",
                            url: url,
                           
                            data: data,
                            dataType: "json",
                            enctype: 'multipart/form-data',
                            processData: false,  // tell jQuery not to process the data
                            contentType: false,

                            success: function (msg) {

                            
                                if(msg.status == 1)
                                {
                                   
                                        $.toast({
                                    heading: 'Success!',
                                    position: 'bottom-right',
                                    text:  msg.msg,
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 4000,
                                    stack: 6
                                    });

                                    $('#ticket-form')[0].reset();
                                    setInterval(() => {
                                        window.location.href ="{{route('dashboard.mytickets')}}" ;
                                    }, 4000); 

                                }
                            
                            
                                else
                                {
                                    $.toast({
                                        heading: 'Error!',
                                        position: 'bottom-right',
                                        text:  msg.error,
                                        loaderBg: '#ff6849',
                                        icon: 'error',
                                        hideAfter: 4000,
                                        stack: 6
                                    });
                                }
                            
                            
                            },
                            beforeSend: function () {
                                
                            }
                    });
                });
               
})()
</script>
@endsection
