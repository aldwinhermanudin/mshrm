@extends('core.app')

@section('content')

<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<title>2016 mshrm ⋅ Work History</title>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Work History
            <small>Work History Record.</small>
          </h1>

          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Work History Record</li>
          </ol>
        </section>

        <section class="content">
          <div id="form_feedback"></div>

      	  <div class="row">
              <div class="col-md-6">
                <div class="box box-info">

                  <form id="form_1" method="post" autocomplete="off">
                    <div class="box-header with-border">
                      <h3 class="box-title">Work History Record ⋅ <span class="label label-info">Manually insert data</span></h3>
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
                        <label>Contract Start</label>
                        <input type="text" class="form-control" id="form_1_masa_kontrak_mulai" name="masa_kontrak_mulai" placeholder="contact start">
                      </div>

                      <div class="form-group">
                        <label>Contract End</label>
                        <input type="text" class="form-control" id="form_1_masa_kontrak_selesai" name="masa_kontrak_selesai" placeholder="contract end">
                      </div>

                      <div class="form-group">
                        <label>Previous Institution / Company</label>
                        <input type="text" class="form-control" id="form_1_instansi_terakhir" name="instansi_terakhir" placeholder="previous institution / company" autocomplete="off">
                      </div>

                      <div class="form-group">
                        <label>Previous Rank</label>
                        <input type="text" class="form-control" id="form_1_pangkat" name="pangkat" placeholder="previous rank" autocomplete="off">
                      </div>

                      <div class="form-group">
                        <label>Previous Position</label>
                        <input type="text" class="form-control" id="form_1_jabatan" name="jabatan" placeholder="previous position" autocomplete="off">
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

    $('#form_1_masa_kontrak_mulai').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#form_1_masa_kontrak_selesai').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $("#form_1").submit(function(){
        var formData = new FormData($(this)[0]);
        $("#form_1_button_submit").prop('disabled',true);
        $.ajax({
            url: '/admin/WorkHistory',
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
