@extends('core.app')

@section('content')

<title>2016 mshrm ⋅ Add Employee</title>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Add Employee <small>Register new employees.</small></h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Employee</li>
        <li class="active">Add Employee</li>
      </ol>
    </section>

    <section class="content">
      <div id="form_feedback"></div>

      <div class="row">
        <div class="col-md-12">

          <div class="box box-success">

            <!--BOX HEADER START-->
            <div class="box-header with-border">
              <h3 class="box-title">Add an Employee ⋅ <span class="label label-success">With .CSV file</span></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!--BOX HEADER END-->

            <form id="form_2" method="post" enctype="multipart/form-data" autocomplete="off" action="/system/EmployeeRegisterFile">

              <!--BOX BODY START-->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">

                    <input type="hidden" id="form_2_token" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                      <input type="file" id="form_2_file_csv" name="file_csv">
                      <p class="help-block">Only in .CSV Format.</p>
                    </div>
                  </div>
                </div>

              </div>
                <!--BOX BODY END-->

                <!--BOX FOOTER START-->
              <div class="box-footer">
                <button type="submit" id="form_2_button_submit" class="btn btn-info btn-flat">Add</button>
                <button type="reset" id="form_2_button_reset" class="btn btn-info btn-flat">Reset</button>
              </div>
                <!--BOX FOOTER END-->
            </form>

          </div>

          <div class="box box-info">

            <!--BOX HEADER START-->
            <div class="box-header with-border">
              <h3 class="box-title">Add an Employee ⋅ <span class="label label-info">Manually insert data</span></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!--BOX HEADER END-->

            <form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">

              <!--BOX BODY START-->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">

                    <h4><b>Personal Data</b></h4>
                    <hr>

                    <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                      <label>NIP</label>
                      <input type="text" class="form-control" id="form_1_nip" name="nip" placeholder="nip">
                    </div>

                    <div class="form-group">
                      <label>Branch</label>
                      <select class="form-control" id="form_1_branch" name="branch" placeholder="branch">
                        @foreach ($results_3 as $result_3)
                        <option value="{{ $result_3->nama_branch}}">{{ $result_3->nama_branch }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="form_1_nama_lengkap" name="nama_lengkap" placeholder="full name">
                    </div>

                    <div class="form-group">
                      <label>Birth Date</label>
                      <input type="text" class="form-control" id="form_1_tanggal_lahir" name="tanggal_lahir" placeholder="birth date">
                    </div>

                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" id="form_1_jenis_kelamin" name="jenis_kelamin" placeholder="gender">
                        <option value="PRIA">Male</option>
                        <option value="WANITA">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Telephone Number</label>
                      <input type="text" class="form-control" id="form_1_no_telp" name="no_telp" placeholder="telephone number">
                    </div>

                    <div class="form-group">
                      <label>Cellphone Number</label>
                      <input type="text" class="form-control" id="form_1_no_hp" name="no_hp" placeholder="cellphone number">
                    </div>

                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" class="form-control" id="form_1_email" name="email" placeholder="email address" autocomplete="off" onChange="javascript:this.value=this.value.toLowerCase();">
                    </div>

                    <div class="form-group">
                      <label>Marital Status</label>
                      <select class="form-control" id="form_1_status_pernikahan" name="status_pernikahan" placeholder="marital status">
                        <option value="TK">Not Married</option>
                        <option value="K0">Married, 0 children</option>
                        <option value="K1">Married, 1 children</option>
                        <option value="K2">Married, 2 childrens</option>
                        <option value="K3">Married, 3 childrens</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Nationality</label>
                      <select class="form-control" id="form_1_kewarganegaraan" name="kewarganegaraan" placeholder="nationality">
                        <option value="INDONESIA">Indonesia (WNI)</option>
                        <option value="NON-INDONESIA">Foreign (WNA)</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Residence ID number (KTP)</label>
                      <input type="text" class="form-control" id="form_1_no_ktp" name="no_ktp" placeholder="residence id number (ktp)" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <textarea class="form-control" id="form_1_alamat" name="alamat" rows="3" placeholder="address"></textarea>
                    </div>

                    <div class="form-group">
                      <label>Province (Provinsi)</label>
                      <select class="form-control" id="form_1_provinsi" name="provinsi" placeholder="province (provinsi)">
                        <option value=""></option>
                        @foreach ($results_2 as $result_2)
                        <option value="{{ $result_2->id }}">{{ $result_2->id }}. {{ $result_2->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div id="form_1_content_kota">
                      <div class="form-group">
                        <label>City (Kota)</label>
                        <select class="form-control" id="form_1_kota" name="kota" placeholder="city (kota)">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Postal Code</label>
                      <input type="text" class="form-control" id="form_1_kode_pos" name="kode_pos" placeholder="postal code" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Tribe</label>
                      <input type="text" class="form-control" id="form_1_suku" name="suku" placeholder="tribe" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Able to Read?</label>
                      <select class="form-control" id="form_1_literasi_membaca" name="literasi_membaca" placeholder="able to read?">
                        <option value="YA">Yes</option>
                        <option value="TIDAK">No</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Able to Write?</label>
                      <select class="form-control" id="form_1_literasi_menulis" name="literasi_menulis" placeholder="able to write?">
                        <option value="YA">Yes</option>
                        <option value="TIDAK">No</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Highest Education</label>
                      <select class="form-control" id="form_1_pendidikan" name="pendidikan" placeholder="highest education">
                        <option value="TIDAK SEKOLAH">Never Went to School</option>
                        <option value="SD">Elementary School (SD)</option>
                        <option value="SMP">Middle School (SMP)</option>
                        <option value="SMA">High School (SMA)</option>
                        <option value="SMK">High School (SMK)</option>
                        <option value="STM">High School (STM)</option>
                        <option value="S1">Bachelor's Degree (S1)</option>
                        <option value="S2">Master's Degree (S2)</option>
                        <option value="S3">Doctoral Degree (S3)</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Sickness History</label>
                      <textarea class="form-control" id="form_1_riwayat_penyakit" name="riwayat_penyakit" rows="3" placeholder="sickness history"></textarea>
                    </div>

                    <div class="form-group">
                      <label>BPJS Health</label>
                      <input type="text" class="form-control" id="form_1_bpjs_kesehatan" name="bpjs_kesehatan" placeholder="bpjs health" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>BPJS Employment</label>
                      <input type="text" class="form-control" id="form_1_bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan" placeholder="bpjs employment" autocomplete="off">
                    </div>

                    <div class="form-group ">
                      <label>Insurance</label>
                      <input type="text" class="form-control" id="form_1_asurasi" name="asurasi" placeholder="insurance" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Position Type</label>
                      <select class="form-control" id="form_1_jenis_jabatan" name="jenis_jabatan" placeholder="position type">
                        <option value=""></option>
                        @foreach ($results as $result)
                        <option value="{{ $result->kode_jabatan}}">{{ $result->kode_jabatan }}. {{ $result->nama_jabatan }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div id="form_1_content_jenis_divisi">
                      <div class="form-group">
                        <label>Location Type</label>
                        <select class="form-control" id="form_1_jenis_divisi" name="jenis_divisi" placeholder="division type">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Profile Picture</label>
                      <input type="file" id="form_1_picture" name="picture">
                      <p class="help-block">Profile picture in JPEG format.</p>
                    </div>
                  </div>

                  <div class="col-md-6">

                    <h4><b>Family Data</b></h4>
                    <hr>

                    <div class="form-group">
                      <label>Spouse's Name</label>
                      <input type="text" class="form-control" id="form_1_nama_pasangan" name="nama_pasangan" placeholder="spouse's name" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Number of Children</label>
                      <select class="form-control" id="form_1_jumlah_anak" name="jumlah_anak" placeholder="number of children">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>First Child's Name</label>
                      <input type="text" class="form-control" id="form_1_nama_anak_1" name="nama_anak_1" placeholder="first child's name" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Second Child's Name</label>
                      <input type="text" class="form-control" id="form_1_nama_anak_2" name="nama_anak_2" placeholder="second child's name" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Third Child's Name</label>
                      <input type="text" class="form-control" id="form_1_nama_anak_3" name="nama_anak_3" placeholder="third child's name" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Mother's name</label>
                      <input type="text" class="form-control" id="form_1_nama_ibu" name="nama_ibu" placeholder="mother's name" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Father's name</label>
                      <input type="text" class="form-control" id="form_1_nama_ayah" name="nama_ayah" placeholder="father's name" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Family's Contact 1</label>
                      <input type="text" class="form-control" id="form_1_kontak_keluarga_1" name="kontak_keluarga_1" placeholder="family's contact 1" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Family's Contact 2</label>
                      <input type="text" class="form-control" id="form_1_kontak_keluarga_2" name="kontak_keluarga_2" placeholder="family's contact 2" autocomplete="off">
                    </div>

                    <br>
                    <h4><b>Work History</b></h4>
                    <hr>

                    <div class="form-group">
                      <label>Previous Institution / Company</label>
                      <input type="text" class="form-control" id="form_1_instansi_terakhir" name="instansi_terakhir" placeholder="previous institution / company">
                    </div>

                    <div class="form-group">
                      <label>Previous Rank</label>
                      <input type="text" class="form-control" id="form_1_pangkat" name="pangkat" placeholder="previous rank">
                    </div>

                    <div class="form-group">
                      <label>Previous Position</label>
                      <input type="text" class="form-control" id="form_1_jabatan" name="jabatan" placeholder="previous position">
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
                      <label>Join Date</label>
                      <input type="text" class="form-control" id="form_1_tanggal_bergabung" name="tanggal_bergabung" placeholder="join date">
                    </div>

                  </div>
                </div>

              </div>
                <!--BOX BODY END-->

                <!--BOX FOOTER START-->
              <div class="box-footer">
                <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat">Add</button>
                <button type="reset" id="form_1_button_reset" class="btn btn-info btn-flat">Reset</button>
              </div>
                <!--BOX FOOTER END-->
            </form>

          </div>
        </div>

      </div>
    </section>
  </div>

<script>
$(document).ready(function(){

  $('#form_1_tanggal_lahir').datetimepicker({
      format: 'YYYY-MM-DD'
  });

  $('#form_1_masa_kontrak_mulai').datetimepicker({
      format: 'YYYY-MM-DD'
  });

  $('#form_1_masa_kontrak_selesai').datetimepicker({
      format: 'YYYY-MM-DD'
  });

  $('#form_1_tanggal_bergabung').datetimepicker({
      format: 'YYYY-MM-DD'
  });

  $("#form_1").submit(function(){
      var formData = new FormData($(this)[0]);
      $("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
  		$("#form_1_button_submit").prop('disabled', true);
      $.ajax({
          url: '/system/EmployeeRegister',
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

  $("#form_2").submit(function(){
      var formData = new FormData($(this)[0]);
      $("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
  		$("#form_2_button_submit").prop('disabled', true);
      $.ajax({
          url: '/system/EmployeeRegisterFile',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            if (data == 'OK')
      			{
      				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
      				$("#form_2_button_submit").prop('disabled',false);
      			}
      			else
      			{
      				$("#form_feedback").empty().html(data);
      				$("#form_2_button_submit").prop('disabled',false);
      			}
          },
          error: function (data) {
            $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
    				$("#form_2_button_submit").prop('disabled',false);
          },
          cache: false,
          contentType: false,
          processData: false
      });
      return false;
  });

	$("#button_check_csv").click(function(){
		$("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
		$("#form_feedback").load("/system/UserRegisterCheck/1");
	});

	$("#form_1_jenis_jabatan").on('change', function(){
		var ajax_jenis_jabatan = $("#form_1_jenis_jabatan").val();
		$("#form_1_content_jenis_divisi").load("/ajax/ContentDivision/"+ajax_jenis_jabatan);
	});

	$("#form_1_provinsi").on('change', function(){
		var ajax_provinsi = $("#form_1_provinsi").val();
		$("#form_1_content_kota").load("/ajax/ContentCity/"+ajax_provinsi);
	});

});
</script>

<script src="{{ asset('/TAGInput/js/jquery.knob.js') }}"></script>
<script src="{{ asset('/TAGInput/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('/TAGInput/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('/TAGInput/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('/TAGInput/js/script.js') }}"></script>

@endsection
