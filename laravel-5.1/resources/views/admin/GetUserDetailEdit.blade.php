<div class="row">
  <div class="col-md-12" style="text-align: center">
    <img style="width:175px;" src="{{asset('/assets/uploads/images')}}/{{ $nip }}" class="img-circle" alt="No Profile Picture."/>
  </div>
</div>

<hr>

<div id="form_feedback"></div>

@foreach ($results as $result)
<form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Personal Information</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <!-- PERSONAL INFO-->
          <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
            <input type="hidden" id="form_1_nip" name="nip" value="{{ $result->nip }}">
          </div>

          <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="form-control" id="form_1_nama_lengkap" name="nama_lengkap" value="{{ $result->nama_lengkap }}">
          </div>

          <div class="form-group">
            <label>Birth Date</label>
            <input type="text" class="form-control" id="form_1_tanggal_lahir" name="tanggal_lahir" value="{{ $result->tanggal_lahir }}">
          </div>

          <div class="form-group">
            <label>Gender</label>
            <p class="form-control-static">{{ $result->jenis_kelamin }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_jenis_kelamin" name="jenis_kelamin" placeholder="gender">
                  <option value="PRIA">Male (PRIA)</option>
                  <option value="WANITA">Female (WANITA)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Telephone Number</label>
            <input type="text" class="form-control" id="form_1_no_telp" name="no_telp" value="{{ $result->no_telp }}">
          </div>

          <div class="form-group">
            <label>Cellphone Number</label>
            <input type="text" class="form-control" id="form_1_no_hp" name="no_hp" value="{{ $result->no_hp }}">
          </div>

          <div class="form-group">
            <label>Email Address</label>
            <input type="text" class="form-control" id="form_1_email" name="email" value="{{ $result->email }}" onChange="javascript:this.value=this.value.toLowerCase();">
          </div>

          <div class="form-group">
            <label>Marital Status</label>
            <p class="form-control-static">{{ $result->status_pernikahan }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_status_pernikahan" name="status_pernikahan" placeholder="marital status">
                  <option value="TK">Not Married (TK)</option>
                  <option value="K0">Married, 0 children (K0)</option>
                  <option value="K1">Married, 1 children (K1)</option>
                  <option value="K2">Married, 2 childrens (K2)</option>
                  <option value="K3">Married, 3 childrens (K3)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Nationality</label>
            <p class="form-control-static">{{ $result->kewarganegaraan }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_kewarganegaraan" name="kewarganegaraan" placeholder="nationality">
                  <option value="INDONESIA">Indonesia (WNI)</option>
                  <option value="NON-INDONESIA">Foreign (WNA)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Residence ID number (KTP)</label>
            <input type="text" class="form-control" id="form_1_no_ktp" name="no_ktp" value="{{ $result->no_ktp }}">
          </div>

          <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" id="form_1_alamat" name="alamat" rows="3" placeholder="address">{{ $result->alamat }}</textarea>
          </div>

          <div class="form-group">
            <label>Province</label>
            <p class="form-control-static">{{ $result->provinsi }}. {{ $result->provinsi_nama }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_provinsi" name="provinsi" placeholder="province (provinsi)">
                  <option value=""></option>
                  @foreach ($provinces as $province)
                  <option value="{{ $province->id }}">{{ $province->id }}. {{ $province->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>City</label>
            <p class="form-control-static">{{ $result->kota }}. {{ $result->kota_nama }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div id="form_1_content_kota">
                <div class="form-group">
                  <label><span class="label label-success">Change to edit</span></label>
                  <select class="form-control" id="form_1_kota" name="kota" placeholder="city (kota)">
                    <option value=""></option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Postal Code</label>
            <input type="text" class="form-control" id="form_1_kode_pos" name="kode_pos" value="{{ $result->kode_pos }}">
          </div>

          <div class="form-group">
            <label>Tribe</label>
            <p class="form-control-static">{{ $result->suku }}</p>
            <input type="text" class="form-control" id="form_1_suku" name="suku" value="{{ $result->suku }}">
          </div>

          <div class="form-group">
            <label>Able to Read?</label>
            <p class="form-control-static">{{ $result->literasi_membaca }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_literasi_membaca" name="literasi_membaca" placeholder="able to read?">
                  <option value="YA">Yes (YA)</option>
                  <option value="TIDAK">No (TIDAK)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Able to Write?</label>
            <p class="form-control-static">{{ $result->literasi_menulis }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_literasi_menulis" name="literasi_menulis" placeholder="able to write?">
                  <option value="YA">Yes (YA)</option>
                  <option value="TIDAK">No (TIDAK)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Highest Education</label>
            <p class="form-control-static">{{ $result->pendidikan }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
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
            </div>
          </div>

          <div class="form-group">
            <label>Sickness History</label>
            <textarea class="form-control" id="form_1_riwayat_penyakit" name="riwayat_penyakit" rows="3">{{ $result->riwayat_penyakit }}</textarea>
          </div>

          <div class="form-group">
            <label>BPJS Health</label>
            <input type="text" class="form-control" id="form_1_bpjs_kesehatan" name="bpjs_kesehatan" value="{{ $result->bpjs_kesehatan }}">
          </div>

          <div class="form-group">
            <label>BPJS Employment</label>
            <input type="text" class="form-control" id="form_1_bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan" value="{{ $result->bpjs_ketenagakerjaan }}">
          </div>

          <div class="form-group">
            <label>Insurance</label>
            <input type="text" class="form-control" id="form_1_asurasi" name="asurasi" value="{{ $result->asurasi }}">
          </div>

          <div class="form-group">
            <label>Position Type</label>
            <p class="form-control-static">{{ $result->jenis_jabatan }}. {{ $result->jenis_jabatan_nama }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_jenis_jabatan" name="jenis_jabatan" placeholder="position type">
                  <option value=""></option>
                  @foreach ($positions as $position)
                  <option value="{{ $position->kode_jabatan}}">{{ $position->kode_jabatan }}. {{ $position->nama_jabatan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Division Type</label>
            <p class="form-control-static">{{ $result->jenis_divisi }}. {{ $result->jenis_divisi_nama }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div id="form_1_content_jenis_divisi">
                <div class="form-group">
                  <label><span class="label label-success">Change to edit</span></label>
                  <select class="form-control" id="form_1_jenis_divisi" name="jenis_divisi" placeholder="division type">
                    <option value=""></option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Start Date</label>
            <input type="text" class="form-control" id="form_1_created_at" name="created_at" value="{{ $result->created_at }}" disabled>
          </div>

          <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" id="form_1_picture" name="picture">
            <p class="help-block">Profile picture in JPEG format. Ignore this to not change the profile picture.</p>
          </div>
          <!-- PERSONAL INFO END -->
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Family Information</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <!-- FAMILY INFO -->
          <div class="form-group">
            <label>Spouse's Name</label>
            <input type="text" class="form-control" id="form_1_nama_pasangan" name="nama_pasangan" value="{{ $result->nama_pasangan }}">
          </div>

          <div class="form-group">
            <label>Number of Children</label>
            <p class="form-control-static">{{ $result->jumlah_anak }}</p>
          </div>

          <div class="panel panel-default">
            <div class="panel-body" style="background-color: whitesmoke">
              <div class="form-group">
                <label><span class="label label-success">Change to edit</span></label>
                <select class="form-control" id="form_1_jumlah_anak" name="jumlah_anak" placeholder="number of children">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>First Child's Name</label>
            <input type="text" class="form-control" id="form_1_nama_anak_1" name="nama_anak_1" value="{{ $result->nama_anak_1 }}">
          </div>

          <div class="form-group">
            <label>Second Child's Name</label>
            <input type="text" class="form-control" id="form_1_nama_anak_2" name="nama_anak_2" value="{{ $result->nama_anak_2 }}">
          </div>

          <div class="form-group">
            <label>Third Child's Name</label>
            <input type="text" class="form-control" id="form_1_nama_anak_3" name="nama_anak_3" value="{{ $result->nama_anak_3 }}">
          </div>

          <div class="form-group">
            <label>Mother's Name</label>
            <input type="text" class="form-control" id="form_1_nama_ibu" name="nama_ibu" value="{{ $result->nama_ibu }}">
          </div>

          <div class="form-group">
            <label>Father's Name</label>
            <input type="text" class="form-control" id="form_1_nama_ayah" name="nama_ayah" value="{{ $result->nama_ayah }}">
          </div>

          <div class="form-group">
            <label>Family's Contact 1</label>
            <input type="text" class="form-control" id="form_1_kontak_keluarga_1" name="kontak_keluarga_1" value="{{ $result->kontak_keluarga_1 }}">
          </div>

          <div class="form-group">
            <label>Family's Contact 2</label>
            <input type="text" class="form-control" id="kontak_keluarga_2" name="kontak_keluarga_2" value="{{ $result->kontak_keluarga_2 }}">
          </div>
          <!-- FAMILY INFO END -->
        </div>
      </div>

      <br />

      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Work History</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <!-- WORK HISTORY -->
          <div class="form-group">
            <label>Previous Institution / Company</label>
            <input type="text" class="form-control" id="form_1_instansi_terakhir" name="instansi_terakhir" value="{{ $result->instansi_terakhir }}">
          </div>

          <div class="form-group">
            <label>Previous Rank</label>
            <input type="text" class="form-control" id="form_1_pangkat" name="pangkat" value="{{ $result->pangkat }}">
          </div>

          <div class="form-group">
            <label>Previous Position</label>
            <input type="text" class="form-control" id="form_1_jabatan" name="jabatan" value="{{ $result->jabatan }}">
          </div>

          <div class="form-group">
            <label>Contract Start</label>
            <input type="text" class="form-control" id="form_1_masa_kontrak_mulai" name="masa_kontrak_mulai" value="{{ $result->masa_kontrak_mulai }}">
          </div>

          <div class="form-group">
            <label>Contract End</label>
            <input type="text" class="form-control" id="form_1_masa_kontrak_selesai" name="masa_kontrak_selesai" value="{{ $result->masa_kontrak_selesai }}">
          </div>

          <div class="form-group">
            <label>Join Date</label>
            <input type="text" class="form-control" id="form_1_tanggal_bergabung" name="tanggal_bergabung" value="{{ $result->tanggal_bergabung }}">
          </div>

          <div class="form-group">
            <label>Status</label>
            <input type="text" class="form-control" id="form_1_status" name="status" value="{{ $result->status }}">
          </div>

          <div class="form-group">
            <label>Performance Record / Performance Note</label>
            <textarea class="form-control" id="form_1_catatan_kinerja" name="catatan_kinerja" rows="10">{{ $result->catatan_kinerja}}</textarea>
          </div>
          <!-- WORK HISTORY END -->
        </div>
      </div>
    </div>

  </div>

  <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat" style="width: 100%">Save Changes</button>
</form>
@endforeach

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
          url: '/admin/UserDetail',
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

	$("#form_1_provinsi").on('change', function(){
		var ajax_provinsi = $("#form_1_provinsi").val();
		$("#form_1_content_kota").load("/ajax/ContentCity/"+ajax_provinsi);
	});

  $("#form_1_jenis_jabatan").on('change', function(){
    var ajax_jenis_jabatan = $("#form_1_jenis_jabatan").val();
    $("#form_1_content_jenis_divisi").load("/ajax/ContentDivision/"+ajax_jenis_jabatan);
  });

});
</script>
