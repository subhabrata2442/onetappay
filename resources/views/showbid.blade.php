<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="html5, html 5, video, audio, html5video, html 5 video, html 5 audio, flash, h.264, h264, mp4, mp3, wav, aac, web, internet"/>
<title>Wellcome</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/material-design-iconic-font.min.css') }}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/front/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/front/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/front/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/front/dist/css/login.css') }}">
<script>
 var base_url = "{{url('/')}}";
 var csrf_token = "{{csrf_token()}}";
 var prop = <?php echo json_encode(array('url'=>url('/'), 'ajaxurl' => url('/ajaxpost'),  'csrf_token'=>csrf_token()));?>;
</script>
</head>

<body class="hold-transition login-page">
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped text-nowrap tableMd">
                <thead>
                  <tr>
                    <th>Bid Number</th>
                    <th>Total Bid</th>
                    <!--<th>Amount (₹)</th>-->
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach($result['singleBidResult'] as $row)
                <tr>
                  <td>{{ $row['digit'] }}</td>
                  <td>{{ $row['totalBid'] }}</td>
                  <!--<td>{{ $row['amount'] }}</td>-->
                  <td>@if($row['status']=='p')<small class="label bg-yellow">Pending</small>@elseif($row['status']=='l')<small class="label bg-red">Loss</small>@else($row['status']=='w')<small class="label bg-green">Win</small>@endif</td>
                </tr>
                @endforeach
                  </tbody>
                
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="" method="get">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                  <div class="form-group">
                    <select class="selectOption" name="cat_id" id="category_id">
                      <option value="">Choose..</option>
                      
                      
                      
                      
                      
                      @foreach($category_list as $row)
                      
                      
                      
                      
                      
                      <option value="{{ $row->id }}" @php if(isset($_GET['cat_id'])){if($row->id==$_GET['cat_id']){ echo 'selected="selected"';}} @endphp> {{ $row->label }} </option>
                      
                      
                      
                      
                      
                      @endforeach
                      
                    
                    
                    
                    
                    </select>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                  <div class="form-group">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <input type="text" name="date" class="form-control form-control-sm datetimepicker-input" value="{{ $current_date }}" data-target="#reservationdate"/>
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                  <div class="form-group">
                    <select class="selectOption" name="slot_id" id="time_slot_id">
                      <option value="">Choose..</option>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      @foreach($time_slots as $row)
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      <option value="{{ $row->id }}" @php if(isset($_GET['slot_id'])){if($row->id==$_GET['slot_id']){ echo 'selected="selected"';}} @endphp> {{ $row->from_time }} - {{ $row->to_time }} </option>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                        @endforeach
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group w-100 d-flex justify-content-center">
                    <button type="button" class="btn btn-info" id="add_more_btn">ADD</button>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group w-100 d-flex justify-content-center">
                    <button type="submit" class="btn btn-info">SEARCH</button>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group w-100 d-flex justify-content-center">
                    <button type="button" class="btn btn-info" id="show_btn">Show</button>
                  </div>
                </div>
              </div>
              <div class="row" id="user_section" style="display:none">
                <?php if(isset($_GET['s'])){ ?>
                <?php for($i=0;count($_GET['s'])>$i;$i++){ ?>
                <?php if($_GET['s'][$i]!=''){ ?>
                <div class="col-lg-1 col-md-1 col-sm-6 col-12">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name="s[]" class="form-control" value="{{ $_GET['s'][$i] }}"/>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <?php } ?>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="{{ asset('public/front/plugins/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 

<!-- DataTables  & Plugins --> 
<script src="{{ asset('public/front/plugins/datatables/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> 
<script src="{{ asset('public/front/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('public/front/dist/js/adminlte.min.js') }}"></script> 
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('public/front/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- InputMask --> 
<script src="{{ asset('public/front/plugins/moment/moment.min.js') }}"></script> 
<!-- Tempusdominus Bootstrap 4 --> 
<script src="{{ asset('public/front/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> 
<script>
$(function () {
	$('#example1').DataTable();
});

//Date picker
$('#reservationdate').datetimepicker({
	format: 'YYYY-MM-DD'
});

$('#add_more_btn').click(function(e) {
	$('#user_section').show();
	$('#user_section').append('<div class="col-lg-3 col-md-3 col-sm-6 col-12"><div class="form-group"><input type="text" name="s[]" class="form-control" value=""></div></div>');
});

$('#show_btn').click(function(e) {
	$('#user_section').show();
	
})

$('#category_id').change(function(e) {
    var category_id = $(this).val();
    if (category_id != '') {
        $.ajax({
            url: prop.ajaxurl,
            type: 'post',
            data: {
                category_id: category_id,
                action: 'get_slot',
                _token: prop.csrf_token
            },
            beforeSend: function() {},
            success: function(response) {
                $('#time_slot_id').html(response);
            }
        });
    }
});
</script>
</body>
</html>
