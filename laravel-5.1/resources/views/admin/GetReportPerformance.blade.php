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

<title>2016 mshrm ⋅ Rekam Kinerja Pegawai</title>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Rekam Kinerja
        <small>Rekam Kinerja Pegawai.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Rekam Kinerja</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">

              <form id="form_1" method="post" autocomplete="off">
                <div class="box-header with-border">
                  <h3 class="box-title">Rekam Kinerja Pegawai ⋅ <span class="label label-info">Masukkan data secara manual</span></h3>
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

                  <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="text" class="form-control" id="form_1_tanggal_mulai" name="tanggal_mulai" placeholder="start date">
                  </div>

                  <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="text" class="form-control" id="form_1_tanggal_selesai" name="tanggal_selesai" placeholder="end date">
                  </div>

                  <div class="form-group">
                    <label>Nama Tugas</label>
                    <input type="text" class="form-control" id="form_1_nama_penugasan" name="nama_penugasan" placeholder="task name" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label>Deskripsi Tugas</label>
                    <textarea class="form-control" id="form_1_keterangan" name="keterangan" rows="3" placeholder="task description"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Catatan Pada Kinerja Pegawai</label>
                    <textarea class="form-control" id="form_1_catatan_kinerja" name="catatan_kinerja" rows="3" placeholder="note on performance"></textarea>
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
                <h3 class="box-title">Ulasan Singkat Pegawai</h3>
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

  <script>
    $(document).ready(function(){
      $('#form_1_tanggal_mulai').datetimepicker({
          format: 'YYYY-MM-DD'
      });

      $('#form_1_tanggal_selesai').datetimepicker({
          format: 'YYYY-MM-DD'
      });

      $("#form_1").submit(function(){
          var formData = new FormData($(this)[0]);
          $("#form_1_button_submit").prop('disabled',true);
          $.ajax({
              url: '/admin/ReportPerformance',
              type: 'POST',
              data: formData,
              async: false,
              success: function (data) {
                if (data == 'OK')
          			{
          				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Sukses!</h5></div>");
          				$("#form_1_button_submit").prop('disabled',false);
          			}
          			else
          			{
          				$("#form_feedback").empty().html(data);
          				$("#form_1_button_submit").prop('disabled',false);
          			}
              },
              error: function (data) {
                $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Terjadi kesalahan, coba lagi dalam waktu dekat.</h5></div>");
        				$("#form_1_button_submit").prop('disabled',false);
              },
              cache: false,
              contentType: false,
              processData: false
          });
          return false;
      });

      $("#form_1_nip").on('change', function(){
    		$("#user_feedback").empty().html("<div class='callout callout-info'><h5>Memeriksa.</h5></div>");

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

<title>2016 mshrm ⋅ Performance Record</title>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Performance Record
        <small>Record Employee's Performance.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Performance Record</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">

              <form id="form_1" method="post" autocomplete="off">
                <div class="box-header with-border">
                  <h3 class="box-title">Record Employee's Performance ⋅ <span class="label label-info">Manually insert data</span></h3>
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

                  <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" class="form-control" id="form_1_tanggal_mulai" name="tanggal_mulai" placeholder="start date">
                  </div>

                  <div class="form-group">
                    <label>End Date</label>
                    <input type="text" class="form-control" id="form_1_tanggal_selesai" name="tanggal_selesai" placeholder="end date">
                  </div>

                  <div class="form-group">
                    <label>Task Name</label>
                    <input type="text" class="form-control" id="form_1_nama_penugasan" name="nama_penugasan" placeholder="task name" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label>Task Description</label>
                    <textarea class="form-control" id="form_1_keterangan" name="keterangan" rows="3" placeholder="task description"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Note on Performance</label>
                    <textarea class="form-control" id="form_1_catatan_kinerja" name="catatan_kinerja" rows="3" placeholder="note on performance"></textarea>
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

  <script>
    $(document).ready(function(){

      $('#form_1_tanggal_mulai').datetimepicker({
          format: 'YYYY-MM-DD'
      });

      $('#form_1_tanggal_selesai').datetimepicker({
          format: 'YYYY-MM-DD'
      });

      $("#form_1").submit(function(){
          var formData = new FormData($(this)[0]);
          $("#form_1_button_submit").prop('disabled',true);
          $.ajax({
              url: '/admin/ReportPerformance',
              type: 'POST',
              data: formData,
              async: false,
              success: function (data) {
                if (data == 'OK')
          			{
          				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
          				$("#form_1_button_submit").prop('disabled',false);
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
