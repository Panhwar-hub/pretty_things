@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
      <div class="main-wrapper">
        <div class="quick-stats-wrapper">
          <div class="row align-items-center mc-b-3">
            <div class="col-lg-6 col-12">
              <div class="primary-heading color-dark">
                <h2>Welcome To Dashboard</h2>
              </div>
            </div>
            <!--<div class="col-lg-6 col-12">-->
            <!--  <div class="text-right">-->
            <!--    <a href="javascript:void(0)" class="primary-btn primary-bg">Download CSV Report</a>-->
            <!--  </div>-->
            <!--</div>-->
          </div>
          <div class="row">
              
          <div class="col-lg-3 col-md-6 col-12">
            <a href="#">
              <div class="status-thumbnail">
                <span><i class="fa fa-long-arrow-up"></i>All Over</span>
                <div class="status-img">
                  <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                </div>
                <div class="status-content">
                  <h3>Totl Orders</h3>
                  <p>{{ $currentmonthorders }}</p> 
                </div>
              </div>
              </a>
            </div>  

            <div class="col-lg-3 col-md-6 col-12">
            <a href="#">
              <div class="status-thumbnail">
                <span><i class="fa fa-long-arrow-up"></i>All Over</span>
                <div class="status-img">
              
                <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
                <div class="status-content">
                  <h3>Total income</h3>
                  <p> $ {{  number_format($orderscount,2) }} </p> 
                </div>
              </div>
              </a>
            </div>  

            <div class="col-lg-3 col-md-6 col-12">
            <a href="#">
              <div class="status-thumbnail">
                <span><i class="fa fa-long-arrow-up"></i>Over all</span>
                <div class="status-img">
                <i class="fa fa-user" aria-hidden="true"></i>
                

                </div>
                <div class="status-content">
                  <h3>Total users</h3>
                  <p> {{count($users)}} </p> 
                </div>
              </div>
              </a>
            </div>  

            <div class="col-lg-3 col-md-6 col-12">
            <a href="#">
              <div class="status-thumbnail">
                <span><i class="fa fa-long-arrow-up"></i>Over all</span>
                <div class="status-img">
         
                <i class="fa fa-envelope" aria-hidden="true"></i>

                </div>
                <div class="status-content">
                  <h3>Total inquiries</h3>
                  <p> {{count($inquiry)}} </p> 
                </div>
              </div>
              </a>
            </div>  
            <div class="col-lg-12">
                  <div><canvas id="myChart"></canvas></div>
                  </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script type="text/javascript">
   
    const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
  ];
  var abca  = [<?php  echo $abc ?>];
  console.log(abca);
  const data = {
    labels: labels,
    datasets: [{
      label: 'Orders',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [<?php  echo $abc ?>],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
  </script>
  <script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

<script data-cfasync="false" defer type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script data-cfasync="false" defer type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#user-table').DataTable();        
    });
</script>
<script type="text/javascript">
(()=>{
  
  /*in page css here*/
})()
</script>
@endsection