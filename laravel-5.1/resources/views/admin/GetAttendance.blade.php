@extends('core.app')
@section('content')

@if (Cookie::get('ms_lang') == null)
  <?php
    $language = 'en';
  ?>
@else
  <?php
    $language = Cookie::get('ms_lang');
  ?>
@endif

@if ($language == 'id')
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<title>2016 mshrm ⋅ Daftar Hadir Pegawai</title>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Daftar Hadir Pegawai
        <small>Daftar Hadir Pegawai.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Daftar Hadir Pegawai</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">

              <form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="box-header with-border">
                  <h3 class="box-title">Catat Daftar Hadir Pegawai ⋅ <span class="label label-info">Masukkan data secara manual</span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>

                <div class="box-body">
                  <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                  <div id="form_1_user_feedback"></div>

                  <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" id="form_1_nip" name="nip" placeholder="nip" autocomplete="off">
                  </div>

                </div>

                <div class="box-footer">
                  <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat">Submit</button>
                  <button type="reset" id="form_1_button_reset" class="btn btn-info btn-flat">Reset</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Employee Review</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div id="employee_review">
                  Informasi Pegawai
                </div>
              </div>
              <div class="box-footer">
              </div>
            </div>
          </div>
        </div>
    </section>

    <section class="content-header">
      <h1>
        Masukkan yang paling baru
        <small>Masukkan yang paling baru.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Masukkan terbaru</li>
      </ol>
    </section>

    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
          <table id="table_1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </thead>
            <tbody id="content_attendance">
              @if (empty($results))
              <tr>
                <td>Empty</td>
                <td>Empty</td>
              </tr>
              @else
              @foreach($results as $result)
              <tr class="success">
                <td>{{ $result->uid }}</td>
                <td>{{ $result->timestamp }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>

    <section class="content-header">
      <h1>
        Masukkan yang sudah dilihat
        <small>Masukkan yang sudah dilihat.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Masukkan lama</li>
      </ol>
    </section>

    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
          <table id="table_1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </thead>
            <tbody>
              @if (empty($results_2))
              <tr>
                <td>Empty</td>
                <td>Empty</td>
              </tr>
              @else
              @foreach($results_2 as $result_2)
              <tr class="warning">
                <td>{{ $result_2->uid }}</td>
                <td>{{ $result_2->timestamp }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>

    <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(document).ready(function(){
      $(function () {
        $("#table_1").DataTable();
      });

      $('#form_1_waktu_terjadi').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
      });
      $('#form_1_waktu_laporan').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
      });

      $("#form_1").submit(function(){
          var formData = new FormData($(this)[0]);
          $("#form_1_button_submit").prop('disabled',true);
          $.ajax({
              url: '/admin/EmployeeAttendance',
              type: 'POST',
              data: formData,
              async: false,
              success: function (data) {
                if (data == 'OK')
          			{
          				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
          				$("#form_1_button_submit").prop('disabled',false);
                  $("#content_attendance").append("<tr class='info'><td>"+$("#form_1_nip").val()+"</td><td>Just Now</td></tr>");
          			}
          			else
          			{
          				$("#form_feedback").empty().html(data);
          				$("#form_1_button_submit").prop('disabled',false);
          			}
              },
              error: function (data) {
                $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
        				$("#form_1_button_submit").prop('disabled',false);
              },
              cache: false,
              contentType: false,
              processData: false
          });
          return false;
      });

      $("#form_1_nip").on('change', function(){
    		$("#user_feedback").empty().html("<div class='callout callout-info'><h5>Checking.</h5></div>");

    		$.post("/system/EmployeeCheck",
    		{
    			_token: $("#form_1_token").val(),
    			nip: $("#form_1_nip").val(),
    		},
    		function(data,status){
    			if (data == 'OK')
    			{
            $("#employee_review").load("/admin/ReportIncidentUser/" + $("#form_1_nip").val());
    			}
    			else
    			{
    				$("#employee_review").empty().html("<br/>" + data);
    			}
    		});
    	});

    });
  </script>
</div>
@else
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<title>2016 mshrm ⋅ Employee's Attendance</title>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Record an attendance
        <small>Record employee's attendance.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Record an attendance</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">

              <form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="box-header with-border">
                  <h3 class="box-title">Record an Attendance ⋅ <span class="label label-info">Manually insert data</span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>

                <div class="box-body">
                  <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                  <div id="form_1_user_feedback"></div>

                  <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" id="form_1_nip" name="nip" placeholder="nip" autocomplete="off">
                  </div>

                </div>

                <div class="box-footer">
                  <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat">Submit</button>
                  <button type="reset" id="form_1_button_reset" class="btn btn-info btn-flat">Reset</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Employee Review</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div id="employee_review">
                  Employee Information
                </div>
              </div>
              <div class="box-footer">
              </div>
            </div>
          </div>
        </div>
    </section>

    <section class="content-header">
      <h1>
        Latest Input
        <small>Latest input of attendance.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Latest Input</li>
      </ol>
    </section>

    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
          <table id="table_1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </thead>
            <tbody id="content_attendance">
              @if (empty($results))
              <tr>
                <td>Empty</td>
                <td>Empty</td>
              </tr>
              @else
              @foreach($results as $result)
              <tr class="success">
                <td>{{ $result->uid }}</td>
                <td>{{ $result->timestamp }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>

    <section class="content-header">
      <h1>
        Old Input
        <small>Old input of attendance.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Old Input</li>
      </ol>
    </section>

    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
          <table id="table_1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </thead>
            <tbody>
              @if (empty($results_2))
              <tr>
                <td>Empty</td>
                <td>Empty</td>
              </tr>
              @else
              @foreach($results_2 as $result_2)
              <tr class="warning">
                <td>{{ $result_2->uid }}</td>
                <td>{{ $result_2->timestamp }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th>NIP</th>
                <th>Timestamp</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>

    <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(document).ready(function(){
      $(function () {
        $("#table_1").DataTable();
      });

      $('#form_1_waktu_terjadi').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
      });
      $('#form_1_waktu_laporan').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
      });

      $("#form_1").submit(function(){
          var formData = new FormData($(this)[0]);
          $("#form_1_button_submit").prop('disabled',true);
          $.ajax({
              url: '/admin/EmployeeAttendance',
              type: 'POST',
              data: formData,
              async: false,
              success: function (data) {
                if (data == 'OK')
          			{
          				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
          				$("#form_1_button_submit").prop('disabled',false);
                  $("#content_attendance").append("<tr class='info'><td>"+$("#form_1_nip").val()+"</td><td>Just Now</td></tr>");
          			}
          			else
          			{
          				$("#form_feedback").empty().html(data);
          				$("#form_1_button_submit").prop('disabled',false);
          			}
              },
              error: function (data) {
                $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
        				$("#form_1_button_submit").prop('disabled',false);
              },
              cache: false,
              contentType: false,
              processData: false
          });
          return false;
      });

      $("#form_1_nip").on('change', function(){
    		$("#user_feedback").empty().html("<div class='callout callout-info'><h5>Checking.</h5></div>");

    		$.post("/system/EmployeeCheck",
    		{
    			_token: $("#form_1_token").val(),
    			nip: $("#form_1_nip").val(),
    		},
    		function(data,status){
    			if (data == 'OK')
    			{
            $("#employee_review").load("/admin/ReportIncidentUser/" + $("#form_1_nip").val());
    			}
    			else
    			{
    				$("#employee_review").empty().html("<br/>" + data);
    			}
    		});
    	});

    });
  </script>
</div>
@endif

@endsection
