@extends('userdash.layouts.dashboard.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
        <div class="message-sender">
                  <div class="col-lg-3">
                  <?php $decrypt = Crypt::encryptString($myticket->id);
               
                  ?>
                  @if($myticket->is_active == 1)
                   <a href="{{route('dashboard.ticketclosed',$decrypt)}}" class="primary-btn primary-bg">Ticket Closed</a>
                   @endif
                  </div>
        <h1 class="subject-ticket">Subject :{{$ticketchat[0]->ticketBelongsTochat->subject}}</h1>                                       
        @foreach($ticketchat  as $t)
 
                                     @if($t->user_id == 1)
                                        <div class="mes-rec">
                                            
                                            <div class="mes-rec-content">
                                                <h6>Admin</h6>
                                                <p>{{$t->message}}</p>
                                                  @if(isset($t->file_path) && !empty($t->file_path))
                                                <a  target="_blank" href="{{asset($t->file_path)}}">View Attachment</a>
                                                @endif
                                            </div>
                                            <div class="mes-rec-time">
                                                <p><?php echo date("d-m-y h:i:sa",strtotime($t->created_at))?></p>
                                            </div>
                                        </div>
                                        @endif
                                        @if($t->user_id ==  Auth::user()->id)
                                        <div class="mes-send">
                                            <div class="mes-send-content">
                                                <h6>{{ Auth::user()->fullname}}</h6>
                                                <p>{{$t->message}}</p>
                                                @if(isset($t->file_path) && !empty($t->file_path))
                                                <a  target="_blank"  href="{{asset($t->file_path)}}">View Attachment</a>
                                                @endif
                                            </div>
                                            
                                            <div class="mes-send-time">
                                                <p><?php echo date("d-m-y h:i:sa",strtotime($t->created_at))?></p>
                                            </div>
                                           
                                        </div>
                                        @endif
                                        @endforeach
                                        </div>

                                    @if($ticketchat[0]->ticketBelongsTochat->is_active == 1)
                                    <div class="message-form main-form">
                                        <form id="chatroom-form">
                                        <div class="form-group">
                                            <textarea rows="4" name="message" class="form-control" placeholder="Type your Message ..."></textarea>
                                            <input type="hidden" name="ticket_id" value="{{$t->ticketBelongsTochat->id}}">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            <input type="file" name="file" class="my-file">
                                            <button class="primary-btn primary-bg add-pets-submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                        </div>
                                        </form>
                                    </div>
                                    @elseif($ticketchat[0]->ticketBelongsTochat->is_active == 2)
                                    <div class="message-form main-form text-center">
                                        <h4>Ticket is closed</h4>
                                    </div>
                                    @else
                                    <div class="message-form main-form text-center">
                                        <h4>Ticket is still pending. Waiting for admin to respond...</h4>
                                    </div>
                                    @endif
        </div>
    </div>
</div>



@endsection
@section('css')
<style type="text/css">
  /*in page css here*/
/* MESSAGES SECTION START */

.messages-sec .card {
  background: transparent;
  border: none;
}

.messages-sec .card .card-header {
  background: transparent;
  border: none;
  padding: 0;
}

.message-tabs {
  flex-direction: column;
  border: none;
}

.message-tabs li a {
  background: transparent;
  color: #000;
  font-size: 14px;
  line-height: 24px;
  display: flex;
  /* justify-content: space-between; */
  align-items: center;
  font-weight: 600;
  border: none !important;
}

.message-tabs li a:hover,
.message-tabs li a:focus {
  border-color: #F8F8F8 !important;
  outline: none;
}

.message-tabs li a.active {
  background-color: transparent !important;
  border: none !important;
}

.messages-sec .card-body {
  padding: 0;
}

.message-tabs li a img {
  width: 70%;
  display: block;
  object-fit: cover;
}

.message-user {
  position: relative;
  flex: 0.5;
  margin-right: 0;
}

.message-tabs li a .message-user::before {
  content: '';
  background-color: #c4c4c4;
  width: 12px;
  height: 12px;
  position: absolute;
  top: 1px;
  left: -2px;
  z-index: 11;
  border: 1px solid #fff;
  border-radius: 50px;
  transition: 0.5s ease-in-out;
}

.message-tabs li a:hover .message-user::before,
.message-tabs li a.active .message-user::before {
  background-color: #24a77e;
}

.message-card button {
  font-size: 16px;
  line-height: 26px;
  color: #7d7d7d;
  border: none !important;
  font-weight: 500;
}

.message-card button i {
  margin-right: 10px;
  font-size: 18px;
}

.message-card button:hover,
.message-card button:focus {
  outline: none;
  border: none;
  text-decoration: none;
  color: #2d97e3;
}

.message-opt ul li a {
  font-size: 16px;
  line-height: 26px;
  color: #7d7d7d;
  padding-left: 42px;
  font-weight: 500;
  text-transform: capitalize;
  position: relative;
  transition: 0.5s ease-in-out;
}

.message-opt ul li a:hover {
  color: #2d97e3;
}

.message-opt ul li a::before {
  content: '';
  background: #cce1ff;
  position: absolute;
  top: 50%;
  left: 15px;
  width: 10px;
  height: 10px;
  border-radius: 50px;
  transform: translateY(-50%);
  transition: 0.5s ease-in-out;
}

.message-opt ul li a:hover::before {
  background-color: #24a77e;
}

.message-opt ul li:not(:last-child) {
  margin: 5px 0px;
}

.message-note {
  padding: 20px;
  background: #f1eff0;
  border: 2px solid #dfddde;
  border-radius: 5px;
  margin: 20px 0;
  text-align: center;
}

.message-note h5 {
  font-size: 18px;
  text-transform: capitalize;
  font-weight: 500;
  margin-bottom: 5px;
}

.message-note p {
  font-size: 15px;
  line-height: 25px;
  color: #000;
  margin: 7px 0px;
}

.message-note a {
  font-size: 13px;
}

.message-search input {
  background: transparent;
  border: none;
  padding-left: 30px;
  outline: none;
}
.message-search input:focus{
  box-shadow: none;
  border-bottom: 2px solid #2d97e3;
  border-radius: 0;
}
.message-search .form-group {
  margin-bottom: 0;
}

.message-search i {
  font-size: 17px;
  line-height: 27px;
  position: absolute;
  left: 5px;
  top: 50%;
  transform: translateY(-50%);
  color: #aaa;
}

.message-sender {
  padding: 20px;
  background-color: #fff;
  margin-top: 20px;
  border-radius: 10px 10px 0px 0px; 
}
.message-sender .mes-rec{
  width: 45%;
  margin-bottom: 20px;
}
.message-sender .mes-rec .mes-rec-content{
  background-color: #e2f0fb;
  padding: 10px 20px 10px;
  border-radius: 10px;
  margin-bottom: 5px;
}
.message-sender .mes-rec .mes-rec-content h6{
  color: #2d3f65;
  font-size: 14px;
  line-height: 24px;
  font-weight: 600;
}
.message-sender .mes-rec .mes-rec-content p{
  color: #999;
  font-size: 16px;
  line-height: 26px;
}
.message-sender .mes-rec .mes-rec-time {
  text-align: right;
  font-size: 12px;
  line-height: 22px;
  font-weight: 600;
  color: #707070;
}
.message-sender .mes-send{
  width: 45%;
  margin-left: auto;
  margin-bottom: 20px;
}
.message-sender .mes-send .mes-send-content{
  background-color: #f2f2f2;
  padding: 10px 20px 10px;
  border-radius: 10px;
  margin-bottom: 5px;
}
.message-sender .mes-send .mes-send-content h6{
  color: #2d3f65;
  font-size: 14px;
  line-height: 24px;
  font-weight: 600;
}
.message-sender .mes-send .mes-send-content p{
  color: #999;
  font-size: 16px;
  line-height: 26px;
}
.message-sender .mes-send .mes-send-time {
  text-align: right;
  font-size: 12px;
  line-height: 22px;
  font-weight: 600;
  color: #707070;
}
.message-form{
  padding: 20px 10px;
  background-color: #f3f3f3;
  border-radius: 0 0 10px 10px;
  position: relative;
}
.message-form input{
  background-color: #fff;
  border-radius: 5px;
}
.message-form button {
  position: absolute;
  top: 50%;
  right: 12px;
  transform: translateY(-77%);
  color: #fff !important;
  background: #233e79 !important;
}
main.dashboard-1 {
  padding: 100px 0;
}

.message-sender {
    height: 600px;
    overflow-y: auto;
}
.message-sender::-webkit-scrollbar {
  width: 0.5em;
}
 
.message-sender::-webkit-scrollbar-track {
  background:#f2f2f2;
  border-radius: 50px;
}
 
.message-sender::-webkit-scrollbar-thumb {
  background-color: #233e79;
  border-radius: 50px;
}
.subject-ticket
{
  text-align:center;
  margin-bottom:20px;
  font-weight:700;
}
.my-file {
    width: 10px;
    display: block;
    position: relative;
    top: -103px;
    height: 10px;
    left: 750px;
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    border: none !important;
}

.my-file::before {
    content: "\f0c6";
    position: relative;
    top: -12px;
    left: -20px;
    /* font-family: 'FontAwesome'; */
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    width: 40px;
    height: 20px;
    font-size: 23px;
    text-align: center;
}
.my-file:hover {
    cursor: pointer;
}


/* MESSAGES SECTION END */
</style>
@endsection
@section('js')
<script type="text/javascript">

(()=>{

    $('.add-pets-submit').click(function(e){
        e.preventDefault();
        
   
        
        var data = new FormData(document.getElementById("chatroom-form"));
    
      
          var url = '{{ route('dashboard.chatmessage') }}';


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
                                   
                                    //     $.toast({
                                    // heading: 'Success!',
                                    // position: 'bottom-right',
                                    // text:  msg.msg,
                                    // loaderBg: '#ff6849',
                                    // icon: 'success',
                                    // hideAfter: 4000,
                                    // stack: 6
                                    // });

                                    $('#chatroom-form')[0].reset();
                                    setInterval(() => {
                                        location.reload();
                                    }, 1000); 

                                }
                            
                            
                                // else
                                // {
                                //     $.toast({
                                //         heading: 'Error!',
                                //         position: 'bottom-right',
                                //         text:  msg.error,
                                //         loaderBg: '#ff6849',
                                //         icon: 'error',
                                //         hideAfter: 4000,
                                //         stack: 6
                                //     });
                                // }
                            
                            
                            },
                            beforeSend: function () {
                                
                            }
                    });
                });
               
    

})()
</script>
@endsection
