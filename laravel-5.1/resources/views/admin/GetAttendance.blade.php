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

<title>2016 mshrm ⋅ Daftar Hadir Pegawai</title>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Daftar Hadir Pegawai
        <small>Daftar Hadir Pegawai.</small>
      </h1>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- TRIGGERING FORM STARTS -->
                  <form id="form_triggering" method="post" autocomplete="off">
                    <input type="hidden" id="form_triggering_token" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label>Tahun</label>
                      <input type="text" class="form-control" id="form_triggering_tahun" name="tahun" placeholder="pilih tahun">
                    </div>
                    <div class="form-group">
                      <label>Bulan</label>
                      <input type="text" class="form-control" id="form_triggering_bulan" name="bulan" placeholder="pilih bulan">
                    </div>
                    <button type="submit" id="form_triggering_button_submit" class="btn btn-info btn-flat">Tampilkan</button>
                  </form>
                  <!-- TRIGGERING FORM ENDS -->
                </div>
              </div>
              <hr>
              <div class="col-md-12" id="attendance_content">
                <p>Pilih dan klik untuk melihat daftar hadir.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- IDS:
      attendance_detail
      attendance_content
    -->

  <section class="content-header">
    <h1>
      Masukkan Daftar Hadir Pegawai
      <small>Masukkan Daftar Hadir Pegawai.</small>
    </h1>
  </section>

  <section class="content">
    <div id="form_feedback"></div>

    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">

            <form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
              <div class="box-header with-border">
                <h3 class="box-title">Masukkan Daftar Hadir Pegawai ⋅ <span class="label label-info">Masukkan data secara manual</span></h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>

              <div class="box-body">
                <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                <div id="form_1_user_feedback"></div>

                <div class="form-group">
                  <label>NIP / UID</label>
                  <select class="form-control selectpicker" id="form_1_uid" name="uid" data-live-search="true">
                    <option data-tokens="" value=""></option>
                    @foreach ($results as $result)
                    <option data-tokens="{{ $result->nama_lengkap }} {{ $result->nip }} {{ $result->uid }}" value="{{ $result->uid }}">{{ $result->nama_lengkap }} &bull; {{ $result->nip }} &bull; {{ $result->uid }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Shift</label>
                  <select class="form-control" id="form_1_shift" name="shift" placeholder="shift">
                    <option value="1">O (OFF)</option>
                    <option value="2">C (BREAK)</option>
                    <option value="3">P (MORNING)</option>
                    <option value="4">S (DAY)</option>
                    <option value="5">M (NIGHT)</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="text" class="form-control" id="form_1_tanggal" name="tanggal" placeholder="pilih tanggal">
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
          <!--
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
          -->
        </div>
      </div>
  </section>

  <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
  $(document).ready(function(){

    $("#form_feedback").load('/admin/EmployeeAttendanceUpdate');

    $('#form_1_tanggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#form_triggering_tahun').datetimepicker({
        format: 'YYYY'
    });

    $('#form_triggering_bulan').datetimepicker({
        format: 'MM'
    });

    $("#form_triggering").submit(function(){
        var formData = new FormData($(this)[0]);
        $("#form_triggering_button_submit").prop('disabled',true);
        $.ajax({
            url: '/admin/EmployeeAttendanceTimeSheet',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
              $("#form_feedback").empty().html("<div class='callout callout-success'><h5>Sukses!</h5></div>");
              $("#attendance_content").empty().html(data);
              $("#form_triggering_button_submit").prop('disabled',false);
            },
            error: function (data) {
              console.log(data);
              $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Terjadi kesalahan, coba dalam waktu dekat.</h5></div>");
              $("#form_triggering_button_submit").prop('disabled',false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });

    $("#form_1").submit(function(){
        var formData = new FormData($(this)[0]);
        $("#form_1_button_submit").prop('disabled',true);
        $.ajax({
            url: '/admin/EmployeeAttendanceRecord',
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
              $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Terjadi kesalahan, coba dalam waktu dekat.</h5></div>");
              $("#form_1_button_submit").prop('disabled',false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
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

<title>2016 mshrm ⋅ Employee's Attendance</title>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Attendance Record
        <small>Record of employee's attendance.</small>
      </h1>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- TRIGGERING FORM STARTS -->
                  <form id="form_triggering" method="post" autocomplete="off">
                    <input type="hidden" id="form_triggering_token" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label>Year</label>
                      <input type="text" class="form-control" id="form_triggering_tahun" name="tahun" placeholder="choose year">
                    </div>
                    <div class="form-group">
                      <label>Month</label>
                      <input type="text" class="form-control" id="form_triggering_bulan" name="bulan" placeholder="choose bulan">
                    </div>
                    <button type="submit" id="form_triggering_button_submit" class="btn btn-info btn-flat">Show</button>
                  </form>
                  <!-- TRIGGERING FORM ENDS -->
                </div>
              </div>
              <hr>
              <div class="col-md-12" id="attendance_content">
                <p>Click show to view record.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- IDS:
      attendance_detail
      attendance_content
    -->

  <section class="content-header">
    <h1>
      Record Attendance Manually
      <small>Record Employee's Attendance.</small>
    </h1>
  </section>

  <section class="content">
    <div id="form_feedback"></div>

    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">

            <form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
              <div class="box-header with-border">
                <h3 class="box-title">Record Employee's Attendance ⋅ <span class="label label-info">Manually insert data</span></h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>

              <div class="box-body">
                <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                <div id="form_1_user_feedback"></div>

                <div class="form-group">
                  <label>NIP / UID</label>
                  <select class="form-control selectpicker" id="form_1_uid" name="uid" data-live-search="true">
                    <option data-tokens="" value=""></option>
                    @foreach ($results as $result)
                    <option data-tokens="{{ $result->nama_lengkap }} {{ $result->nip }} {{ $result->uid }}" value="{{ $result->uid }}">{{ $result->nama_lengkap }} &bull; {{ $result->nip }} &bull; {{ $result->uid }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Shift</label>
                  <select class="form-control" id="form_1_shift" name="shift" placeholder="shift">
                    <option value="1">O (OFF)</option>
                    <option value="2">C (BREAK)</option>
                    <option value="3">P (MORNING)</option>
                    <option value="4">S (DAY)</option>
                    <option value="5">M (NIGHT)</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Date</label>
                  <input type="text" class="form-control" id="form_1_tanggal" name="tanggal" placeholder="choose date">
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
          <!--
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
          -->
        </div>
      </div>
  </section>

  <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
  $(document).ready(function(){

    $("#form_feedback").load('/admin/EmployeeAttendanceUpdate');

    $('#form_1_tanggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#form_triggering_tahun').datetimepicker({
        format: 'YYYY'
    });

    $('#form_triggering_bulan').datetimepicker({
        format: 'MM'
    });

    $("#form_triggering").submit(function(){
        var formData = new FormData($(this)[0]);
        $("#form_triggering_button_submit").prop('disabled',true);
        $.ajax({
            url: '/admin/EmployeeAttendanceTimeSheet',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
              $("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
              $("#attendance_content").empty().html(data);
              $("#form_triggering_button_submit").prop('disabled',false);
            },
            error: function (data) {
              console.log(data);
              $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
              $("#form_triggering_button_submit").prop('disabled',false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });

    $("#form_1").submit(function(){
        var formData = new FormData($(this)[0]);
        $("#form_1_button_submit").prop('disabled',true);
        $.ajax({
            url: '/admin/EmployeeAttendanceRecord',
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
  });
</script>

</div>
@endif

@endsection
