<div class="row">
  <div class="col-md-12" style="text-align: center">
    <img style="width:175px;" src="{{asset('/assets/uploads/images')}}/{{ $nip }}" class="img-circle" alt="No Profile Picture."/>
  </div>
</div>

<hr>

<div id="form_feedback"></div>

@foreach ($results as $result)
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
            <input type="text" id="form_1_nip" name="nip" class="form-control" value="{{ $result->nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Branch</label>
            <p class="form-control-static">{{ $result->branch }}</p>
          </div>

          <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="form-control" id="form_1_nama_lengkap" name="nama_lengkap" value="{{ $result->nama_lengkap }}" disabled>
          </div>

          <div class="form-group">
            <label>Birth Date</label>
            <input type="text" class="form-control" id="form_1_tanggal_lahir" name="tanggal_lahir" value="{{ $result->tanggal_lahir }}" disabled>
          </div>

          <div class="form-group">
            <label>Gender</label>
            <p class="form-control-static">{{ $result->jenis_kelamin }}</p>
          </div>

          <div class="form-group">
            <label>Telephone Number</label>
            <input type="text" class="form-control" id="form_1_no_telp" name="no_telp" value="{{ $result->no_telp }}" disabled>
          </div>

          <div class="form-group">
            <label>Cellphone Number</label>
            <input type="text" class="form-control" id="form_1_no_hp" name="no_hp" value="{{ $result->no_hp }}" disabled>
          </div>

          <div class="form-group">
            <label>Email Address</label>
            <input type="text" class="form-control" id="form_1_email" name="email" value="{{ $result->email }}" disabled>
          </div>

          <div class="form-group">
            <label>Marital Status</label>
            <p class="form-control-static">{{ $result->status_pernikahan }}</p>
          </div>

          <div class="form-group">
            <label>Nationality</label>
            <p class="form-control-static">{{ $result->kewarganegaraan }}</p>
          </div>

          <div class="form-group">
            <label>Residence ID number (KTP)</label>
            <input type="text" class="form-control" id="form_1_no_ktp" name="no_ktp" value="{{ $result->no_ktp }}" disabled>
          </div>

          <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" id="form_1_alamat" name="alamat" rows="3" placeholder="address" disabled>{{ $result->alamat }}</textarea>
          </div>

          <div class="form-group">
            <label>Province</label>
            <p class="form-control-static">{{ $result->provinsi }}. {{ $result->provinsi_nama }}</p>
          </div>

          <div class="form-group">
            <label>City</label>
            <p class="form-control-static">{{ $result->kota }}. {{ $result->kota_nama }}</p>
          </div>

          <div class="form-group">
            <label>Postal Code</label>
            <input type="text" class="form-control" id="form_1_kode_pos" name="kode_pos" value="{{ $result->kode_pos }}" disabled>
          </div>

          <div class="form-group">
            <label>Tribe</label>
            <p class="form-control-static">{{ $result->suku }}</p>
            <input type="text" class="form-control" id="form_1_suku" name="suku" value="{{ $result->suku }}" disabled>
          </div>

          <div class="form-group">
            <label>Able to Read?</label>
            <p class="form-control-static">{{ $result->literasi_membaca }}</p>
          </div>

          <div class="form-group">
            <label>Able to Write?</label>
            <p class="form-control-static">{{ $result->literasi_menulis }}</p>
          </div>

          <div class="form-group">
            <label>Highest Education</label>
            <p class="form-control-static">{{ $result->pendidikan }}</p>
          </div>

          <div class="form-group">
            <label>Sickness History</label>
            <textarea class="form-control" id="form_1_riwayat_penyakit" name="riwayat_penyakit" rows="3" disabled>{{ $result->riwayat_penyakit }}</textarea>
          </div>

          <div class="form-group">
            <label>BPJS Health</label>
            <input type="text" class="form-control" id="form_1_bpjs_kesehatan" name="bpjs_kesehatan" value="{{ $result->bpjs_kesehatan }}" disabled>
          </div>

          <div class="form-group">
            <label>BPJS Employment</label>
            <input type="text" class="form-control" id="form_1_bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan" value="{{ $result->bpjs_ketenagakerjaan }}" disabled>
          </div>

          <div class="form-group">
            <label>Insurance</label>
            <input type="text" class="form-control" id="form_1_asurasi" name="asurasi" value="{{ $result->asurasi }}" disabled>
          </div>

          <div class="form-group">
            <label>Position Type</label>
            <p class="form-control-static">{{ $result->jenis_jabatan }}. {{ $result->jenis_jabatan_nama }}</p>
          </div>

          <div class="form-group">
            <label>Location Type</label>
            <p class="form-control-static">{{ $result->jenis_divisi }}. {{ $result->jenis_divisi_nama }}</p>
          </div>

          <div class="form-group">
            <label>Start Date</label>
            <input type="text" class="form-control" id="form_1_created_at" name="created_at" value="{{ $result->created_at }}" disabled>
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
            <input type="text" class="form-control" id="form_1_nama_pasangan" name="nama_pasangan" value="{{ $result->nama_pasangan }}" disabled>
          </div>

          <div class="form-group">
            <label>Number of Children</label>
            <p class="form-control-static">{{ $result->jumlah_anak }}</p>
          </div>

          <div class="form-group">
            <label>First Child's Name</label>
            <input type="text" class="form-control" id="form_1_nama_anak_1" name="nama_anak_1" value="{{ $result->nama_anak_1 }}" disabled>
          </div>

          <div class="form-group">
            <label>Second Child's Name</label>
            <input type="text" class="form-control" id="form_1_nama_anak_2" name="nama_anak_2" value="{{ $result->nama_anak_2 }}" disabled>
          </div>

          <div class="form-group">
            <label>Third Child's Name</label>
            <input type="text" class="form-control" id="form_1_nama_anak_3" name="nama_anak_3" value="{{ $result->nama_anak_3 }}" disabled>
          </div>

          <div class="form-group">
            <label>Mother's Name</label>
            <input type="text" class="form-control" id="form_1_nama_ibu" name="nama_ibu" value="{{ $result->nama_ibu }}" disabled>
          </div>

          <div class="form-group">
            <label>Father's Name</label>
            <input type="text" class="form-control" id="form_1_nama_ayah" name="nama_ayah" value="{{ $result->nama_ayah }}" disabled>
          </div>

          <div class="form-group">
            <label>Family's Contact 1</label>
            <input type="text" class="form-control" id="form_1_kontak_keluarga_1" name="kontak_keluarga_1" value="{{ $result->kontak_keluarga_1 }}" disabled>
          </div>

          <div class="form-group">
            <label>Family's Contact 2</label>
            <input type="text" class="form-control" id="kontak_keluarga_2" name="kontak_keluarga_2" value="{{ $result->kontak_keluarga_2 }}" disabled>
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
            <input type="text" class="form-control" id="form_1_instansi_terakhir" name="instansi_terakhir" value="{{ $result->instansi_terakhir }}" disabled>
          </div>

          <div class="form-group">
            <label>Previous Rank</label>
            <input type="text" class="form-control" id="form_1_pangkat" name="pangkat" value="{{ $result->pangkat }}" disabled>
          </div>

          <div class="form-group">
            <label>Previous Position</label>
            <input type="text" class="form-control" id="form_1_jabatan" name="jabatan" value="{{ $result->jabatan }}" disabled>
          </div>

          <div class="form-group">
            <label>Contract Start</label>
            <input type="text" class="form-control" id="form_1_masa_kontrak_mulai" name="masa_kontrak_mulai" value="{{ $result->masa_kontrak_mulai }}" disabled>
          </div>

          <div class="form-group">
            <label>Contract End</label>
            <input type="text" class="form-control" id="form_1_masa_kontrak_selesai" name="masa_kontrak_selesai" value="{{ $result->masa_kontrak_selesai }}" disabled>
          </div>

          <div class="form-group">
            <label>Join Date</label>
            <input type="text" class="form-control" id="form_1_tanggal_bergabung" name="tanggal_bergabung" value="{{ $result->tanggal_bergabung }}" disabled>
          </div>

          <div class="form-group">
            <label>Status</label>
            <input type="text" class="form-control" id="form_1_status" name="status" value="{{ $result->status }}" disabled>
          </div>

          <div class="form-group">
            <label>Performance Record / Performance Note</label>
            <textarea class="form-control" id="form_1_catatan_kinerja" name="catatan_kinerja" rows="10" disabled>{{ $result->catatan_kinerja}}</textarea>
          </div>
          <!-- WORK HISTORY END -->
        </div>
      </div>
    </div>

  </div>

  <button type="submit" id="form_1_button_edit" class="btn btn-info btn-flat" style="width: 100%">Edit Data</button>
@endforeach

<script>
$(document).ready(function(){

  $("#form_1_button_edit").click(function(){
    nip = $("#form_1_nip").val();
    $("#modal_content").empty().load("/admin/UserDetailEdit/" + nip);
	});


});
</script>
