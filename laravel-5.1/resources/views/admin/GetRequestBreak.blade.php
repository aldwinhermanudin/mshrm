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
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>

<title>2016 mshrm ⋅ Mengajukan Cuti</title>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Mengajukan Cuti / Libur
        <small>Mengajukan Cuti / Libur Pegawai.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Mengajukan Cuti</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">

              <form id="form_1" method="post" autocomplete="off">
                <div class="box-header with-border">
                  <h3 class="box-title">Mengajukan Cuti / Libur Pegawai ⋅ <span class="label label-info">Masukkan data secara manual</span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>

                <div class="box-body">
                  <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                  <div id="form_1_user_feedback"></div>

                  <div class="form-group">
                    <label>NIP / UID</label>
                    <select class="form-control selectpicker" id="form_1_nip" name="nip" data-live-search="true">
                      <option data-tokens="" value=""></option>
                      @foreach ($results as $result)
                      <option data-tokens="{{ $result->nama_lengkap }} {{ $result->nip }} {{ $result->uid }}" value="{{ $result->nip }}">{{ $result->nama_lengkap }} &bull; {{ $result->nip }} &bull; {{ $result->uid }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>NIP / UID Pegawai Yang Menggantikan</label>
                    <select class="form-control selectpicker" id="form_1_pengganti_nip" name="pengganti_nip" data-live-search="true">
                      <option data-tokens="" value=""></option>
                      @foreach ($results as $result)
                      <option data-tokens="{{ $result->nama_lengkap }} {{ $result->nip }} {{ $result->uid }}" value="{{ $result->nip }}">{{ $result->nama_lengkap }} &bull; {{ $result->nip }} &bull; {{ $result->uid }}</option>
                      @endforeach
                    </select>
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
                    <label>Alasan</label>
                    <textarea class="form-control" id="form_1_alasan_cuti " name="alasan_cuti" rows="8" placeholder="reason"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Nama Supervisor <em>Akan digunakan sebagai referensi kedua, referensi pertama akan diambil secara otomatis dari akun yang mengajukan</em></label>
                    <input type="text" class="form-control" id="form_1_supervisor_nama" name="supervisor_nama" placeholder="supervisor's name">
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

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Ulasan Singkat Pegawai Yang Menggantikan</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div id="substitute_review">
                  Informasi Pegawai Yang Menggantikan
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
              url: '/admin/RequestBreak',
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

      $("#form_1_pengganti_nip").on('change', function(){
    		$("#user_feedback").empty().html("<div class='callout callout-info'><h5>Memeriksa.</h5></div>");

    		$.post("/system/EmployeeCheck",
    		{
    			_token: $("#form_1_token").val(),
    			nip: $("#form_1_pengganti_nip").val(),
    		},
    		function(data,status){
    			if (data == 'OK')
    			{
            $("#substitute_review").load("/admin/ReportIncidentUser/" + $("#form_1_pengganti_nip").val());
    			}
    			else
    			{
    				$("#substitute_review").empty().html("<br/>" + data);
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
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>

<title>2016 mshrm ⋅ Request Break / Leave</title>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Request Break / Leave
        <small>Form To Request Employee's Temporary Break / Leave.</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Request Break</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">

              <form id="form_1" method="post" autocomplete="off">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee's Temporary Break / Leave ⋅ <span class="label label-info">Manually insert data</span></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>

                <div class="box-body">
                  <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                  <div id="form_1_user_feedback"></div>

                  <div class="form-group">
                    <label>NIP / UID</label>
                    <select class="form-control selectpicker" id="form_1_nip" name="nip" data-live-search="true">
                      <option data-tokens="" value=""></option>
                      @foreach ($results as $result)
                      <option data-tokens="{{ $result->nama_lengkap }} {{ $result->nip }} {{ $result->uid }}" value="{{ $result->nip }}">{{ $result->nama_lengkap }} &bull; {{ $result->nip }} &bull; {{ $result->uid }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Subtitute's NIP / UID</label>
                    <select class="form-control selectpicker" id="form_1_pengganti_nip" name="pengganti_nip" data-live-search="true">
                      <option data-tokens="" value=""></option>
                      @foreach ($results as $result)
                      <option data-tokens="{{ $result->nama_lengkap }} {{ $result->nip }} {{ $result->uid }}" value="{{ $result->nip }}">{{ $result->nama_lengkap }} &bull; {{ $result->nip }} &bull; {{ $result->uid }}</option>
                      @endforeach
                    </select>
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
                    <label>Reason</label>
                    <textarea class="form-control" id="form_1_alasan_cuti " name="alasan_cuti" rows="8" placeholder="reason"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Supervisor's Name <em>as secondary reference, primary name reference is taken from this account's data</em></label>
                    <input type="text" class="form-control" id="form_1_supervisor_nama" name="supervisor_nama" placeholder="supervisor's name">
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

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Substitute Review</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div id="substitute_review">
                  Substitute Information
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
              url: '/admin/RequestBreak',
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

      $("#form_1_pengganti_nip").on('change', function(){
    		$("#user_feedback").empty().html("<div class='callout callout-info'><h5>Checking.</h5></div>");

    		$.post("/system/EmployeeCheck",
    		{
    			_token: $("#form_1_token").val(),
    			nip: $("#form_1_pengganti_nip").val(),
    		},
    		function(data,status){
    			if (data == 'OK')
    			{
            $("#substitute_review").load("/admin/ReportIncidentUser/" + $("#form_1_pengganti_nip").val());
    			}
    			else
    			{
    				$("#substitute_review").empty().html("<br/>" + data);
    			}
    		});
    	});
    });
  </script>
  </div>
@endif

@endsection
