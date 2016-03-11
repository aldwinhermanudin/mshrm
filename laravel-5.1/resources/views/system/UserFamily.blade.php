@extends('core.app')

@section('content')
<link href="{{ asset('/TAGInput/css/style.css') }}" rel="stylesheet" />
<title>2016 mshrm ⋅ Add Employee's Family Data</title>
  
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Add Employee's Family Data <small>Add employees' family data.</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Employee</a></li>
        <li class="active">Add Employee's Family Data</li>
      </ol>
    </section>
    
    <section class="content">
	  
	  <div id="form_feedback"></div>
	  
	  <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
              
            <form id="form_1">  
              <div class="box-header with-border">
                <h3 class="box-title">Add an Employee's Family Data ⋅ <span class="label label-info">Manually insert data</span></h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              
              <div class="box-body">
                <input type="hidden" id="form_1_token" value="{{ csrf_token() }}">
                
                <div id="form_1_user_feedback"></div>
                
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control" id="form_1_nip" placeholder="nip" autocomplete="off">
                </div>
          
                <div class="form-group">
                  <label>Spouse's Name</label>
                  <input type="text" class="form-control" id="form_1_nama_pasangan" placeholder="spouse's name" autocomplete="off">
                </div>
                
                <div class="form-group">
                  <label>Number of Children</label>
                  <select class="form-control" id="form_1_jumlah_anak" placeholder="number of children">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
          
                <div class="form-group">
                  <label>First Child's Name</label>
                  <input type="text" class="form-control" id="form_1_nama_anak_1" placeholder="first child's name" autocomplete="off">
                </div>
        
                <div class="form-group">
                  <label>Second Child's Name</label>
                  <input type="text" class="form-control" id="form_1_nama_anak_2" placeholder="second child's name" autocomplete="off">
                </div>
          
                <div class="form-group">
                  <label>Third Child's Name</label>
                  <input type="text" class="form-control" id="form_1_nama_anak_3" placeholder="third child's name" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Mother's name</label>
                  <input type="text" class="form-control" id="form_1_nama_ibu" placeholder="mother's name" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Father's name</label>
                  <input type="text" class="form-control" id="form_1_nama_ayah" placeholder="father's name" autocomplete="off">
                </div>
          
                <div class="form-group">
                  <label>Family's Contact 1</label>
                  <input type="text" class="form-control" id="form_1_kontak_keluarga_1" placeholder="family's contact 1" autocomplete="off">
                </div>
          
                <div class="form-group">
                  <label>Family's Contact 2</label>
                  <input type="text" class="form-control" id="form_1_kontak_keluarga_2" placeholder="family's contact 2" autocomplete="off">
                </div>
              
              </div>
              
              <div class="box-footer">
                <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat">Add</button>
                <button type="reset" id="form_1_button_reset" class="btn btn-info btn-flat">Reset</button>
              </div>
            </form>   
          </div>
        </div>
          
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Add Employees' Family Data ⋅ <span class="label label-success">With .CSV files</span></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form id="upload" method="post" action="/system/UserFamilyFile" enctype="multipart/form-data" style="font-size: 10px;">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <div id="drop">Drop Here <a>Browse</a>
                  <input type="file" name="file_csv" multiple />
                </div>
                <ul></ul>
              </form>
          
            </div>
            <div class="box-footer">
              <button type="button" id="button_check_csv" class="btn btn-success btn-flat">Check for status</button> 
              <a href="{{ url('/resources/csv/2') }}"><button type="button" class="btn btn-link btn-flat">Download acceptable .CSV Format</button></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
        
<script>
$(document).ready(function(){
	
	$("#form_1").submit(function(event)
	{	
		$("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
		$("#form_1_button_submit").prop('disabled', true);
		$.post("/system/UserFamily",
			{
				_token: $("#form_1_token").val(),
				nip: $("#form_1_nip").val(),
				nama_pasangan: $("#form_1_nama_pasangan").val(),
				jumlah_anak: $("#form_1_jumlah_anak").val(),
				nama_anak_1: $("#form_1_nama_anak_1").val(),
				nama_anak_2: $("#form_1_nama_anak_2").val(),
				nama_anak_3: $("#form_1_nama_anak_3").val(),
				nama_ibu: $("#form_1_nama_ibu").val(),
				nama_ayah: $("#form_1_nama_ayah").val(),
				kontak_keluarga_1: $("#form_1_kontak_keluarga_1").val(),
				kontak_keluarga_2: $("#form_1_kontak_keluarga_2").val(),
			},
		function(data,status){
			if (data == 'OK')
			{
				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
				$("#form_1_button_submit").prop('disabled', false);
			}
			else
			{
				$("#form_feedback").empty().html(data);
				$("#form_1_button_submit").prop('disabled', false);
			}
		}).fail(function(data,status){ 
				$("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
				$("#form_1_button_submit").prop('disabled', false);
		});
		event.preventDefault();
	});

	$("#button_check_csv").click(function(){
		$("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
		$("#form_feedback").load("/system/UserRegisterCheck/2");
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
				$("#form_1_user_feedback").empty().html("<div class='callout callout-success'><h5>User with this NIP exists.</h5></div>");
			}
			else
			{
				$("#form_1_user_feedback").empty().html(data);
			}
		});
	});

});
</script>

<script src="{{ asset('/TAGInput/js/jquery.knob.js') }}"></script>
<script src="{{ asset('/TAGInput/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('/TAGInput/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('/TAGInput/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('/TAGInput/js/script.js') }}"></script>

@endsection
