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

    <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(document).ready(function(){

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

    });
  </script>
</div>
@endif

@endsection
