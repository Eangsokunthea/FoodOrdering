<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/BackEnd')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/BackEnd')}}/dist/css/adminlte.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/BackEnd')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- css datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

  <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> -->
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('BackEnd.include.menu')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('BackEnd.include.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  @include('BackEnd.include.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/BackEnd')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/BackEnd')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/BackEnd')}}/dist/js/adminlte.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="{{asset('/BackEnd')}}/dist/js/pages/dashboard2.js"></script>
<!-- DataTables -->
<script src="{{asset('/BackEnd')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/BackEnd')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/BackEnd')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/BackEnd')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- OPTIONAL SCRIPTS AND CHART -->
<script src="{{asset('/BackEnd')}}/plugins/chart.js/Chart.min.js"></script>
<script src="{{asset('/BackEnd')}}/dist/js/demo.js"></script>
<script src="{{asset('/BackEnd')}}/dist/js/pages/dashboard3.js"></script>

<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- datepicker -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
 
<!-- <script>
    var classNumber = document.getElementById('classNumber');
    classNumber.onchange = runBackgroundChange;

    function runBackgroundChange(first){
        var value = first.srcElement.options[first.srcElement.selectedIndex].value;
        if (value == 0) {
            alert('Test');
            document.getElementById('classNumber').style.backgroundColor="#4166f5";
        }else if(value == 1) {
            document.getElementById('classNumber').style.backgroundColor="#32cd32";
        };
    }                                                                                                                                             
</script> -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
    $(function(){
      $(document).on('click', '#delete', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
      });
    });  
</script>
<script type="text/javascript">
  $(document).ready(function(){
    fetch_delivery();

    function fetch_delivery(){
        var _token = $('input[name="_token"]').val();
          $.ajax({
            url : "{{url('/delivery/select-feeship')}}",
            method: 'POST',
            data:{_token:_token},
            success:function(data){
                $('#load_delivery').html(data);
            }
        });
    }
    $(document).on('blur','.fee_feeship_edit',function(){
        var feeship_id = $(this).data('feeship_id');
        var fee_value = $(this).text();
        var _token = $('input[name="_token"]').val();
        // alert(feeship_id);
        // alert(fee_value);
        $.ajax({
            url : "{{url('/delivery/update-Feedelivery')}}",
            method: 'POST',
            data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
            success:function(data){
              fetch_delivery();
            }
        });

      });

    $('.add_delivery').click(function(){
        var delivery = $('.delivery').val();
        var city = $('.city').val();
        var province = $('.province').val();
        var wards = $('.wards').val();
        var fee_ship = $('.fee_ship').val();
        var _token = $('input[name="_token"]').val();
        // alert(city);
        // alert(province);
        // alert(wards);
        // alert(fee_ship);
        $.ajax({
            url : "{{url('/delivery/insert-delivery')}}",
            method: 'POST',
            data:{delivery:delivery,city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
            success:function(data){
              // alert('ok');
                fetch_delivery();
            }
        });

    });
    $('.choose').on('change',function(){
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
        
        if(action=='city'){
            result = 'province';
        }else{
            result = 'wards';
        }
        $.ajax({
            url : "{{url('/delivery/select-delivery')}}",
            method: 'POST',
            data:{action:action,ma_id:ma_id,_token:_token},
            success:function(data){
                $('#'+result).html(data);     
            }
        });
    }); 
  });
</script>

<!-- datepicker -->
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"dd/mm/yy",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
    $( "#datepicker2" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"dd/mm/yy",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
  } );
</script>
<!-- <script>
    new Morris.Line({
    
    element: 'myfirstchart',
    lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
    //         parseTime: false,
    //         hideHover: 'auto',
    //         xkey: 'period',
    //         ykeys: ['order','sales','profit','quantity'],
    //         labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
    data: [
      { year: '2008', value: 20 },
      { year: '2009', value: 10 },
      { year: '2010', value: 5 },
      { year: '2011', value: 5 },
      { year: '2012', value: 20 }
    ],
    
    xkey: 'year',
    
    ykeys: ['value'],
    
    labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
  });
</script> -->
<!-- <script type="text/javascript">
    $(document).ready(function(){

        chart60daysorder();

        var chart = new Morris.Line({
    
          element: 'chart',
          lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
                
          data: [
            { year: '2008', value: 20 },
            { year: '2009', value: 10 },
            { year: '2010', value: 5 },
            { year: '2011', value: 5 },
            { year: '2012', value: 20 }
          ],
          parseTime: false,
          hideHover: 'auto',

          xkey: 'year',
          
          ykeys: ['value'],
          
          labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']

        });
      var chart = new Morris.Bar({
             
          element: 'chart',
          //option chart
          lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
          parseTime: false,
          hideHover: 'auto',
          
          xkey: 'order_date',
          ykeys: ['total_order','sales','profit','quantity'],
          labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
        
        });

      function chart60daysorder(){
          var _token = $('input[name="_token"]').val();
          $.ajax({
              url:"{{url('/days-order')}}",
              method:"POST",
              dataType:"JSON",
              data:{_token:_token},
              
              success:function(data)
                  {
                    chart.setData(JSON.parse(data));
                  }   
          });
      }

      $('.dashboard-filter').change(function(){
          var dashboard_value = $(this).val();
          var _token = $('input[name="_token"]').val();
          // alert(dashboard_value);
          $.ajax({
              url:"{{url('/dashboard-filter')}}",
              method:"POST",
              dataType:"JSON",
              data:{dashboard_value:dashboard_value,_token:_token},
              
              success:function(data)
                  {
                    chart.setData(JSON.parse(data));
                  }   
              });

      });


    $('#btn-dashboard-filter').click(function(){
        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();

         $.ajax({
            url:"{{url('/filter-by-date')}}",
            method:"POST",
            dataType:"JSON",
            data:{from_date:from_date,to_date:to_date,_token:_token},
            
            success:function(data)
                {
                  chart.setData(JSON.parse(data));
                }   
          });

      });

}); -->
    
</script>

</body>
</html>
