@extends('core.app')

@section('content')

<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<title>2016 mshrm ⋅ Report Incident</title>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Report Incident
            <small>Report an Incident.</small>
          </h1>

          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Report Incident</li>
          </ol>
        </section>

        <section class="content">
          <div id="form_feedback"></div>

      	  <div class="row">
              <div class="col-md-6">
                <div class="box box-info">

                  <form id="form_1" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add an Employee's Incident Record ⋅ <span class="label label-info">Manually insert data</span></h3>
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
                        <label>Incident Description</label>
                        <textarea class="form-control" id="form_1_deskripsi" name="deskripsi" rows="3" placeholder="incident description"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Incident Time</label>
                        <input type="text" class="form-control" id="form_1_waktu_terjadi" name="waktu_terjadi" placeholder="choose datetime" autocomplete="off">
                      </div>

                      <div class="form-group">
                        <label>Report Time</label>
                        <input type="text" class="form-control" id="form_1_waktu_laporan" name="waktu_laporan" placeholder="choose datetime" autocomplete="off">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputFile">Evidence Photo</label>
                        <input type="file" id="form_1_evidence" name="evidence">
                        <p class="help-block">Upload an evidence file in format JPEG.</p>
                      </div>

                      <div class="form-group">
                        <label>Reporter's Name</label>
                        <input type="text" class="form-control" id="form_1_pelapor" name="pelapor" placeholder="reporter's name" autocomplete="off">
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
            url: '/admin/ReportIncident',
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
        				$("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Not Uploaded.</h5></div>");
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

  		$.post("/system/UserFamilyCheck",
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
@endsection