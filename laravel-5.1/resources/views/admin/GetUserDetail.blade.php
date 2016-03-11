@extends('core.app')

@section('content')
<link href="{{ asset('/A/css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.css') }}">
<title>2016 mshrm ⋅ Employee Detail ⋅ {{ $nip }}</title>


      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Employee Detail
            <small>{{ $nip }}.</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Employee list</li>
            <li class="active">{{ $nip }}</li>
          </ol>
        </section>
        
        <section class="content">

              <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<div style="text-align:center">
				  <img style="width:175px;" src="{{asset('/assets/uploads/images')}}/{{ $nip }}" alt="No Profile Picture."/>
				</div>
				
				<hr>
				
				<div id="form_feedback"></div>
				
		        <div class="row">
		          <div class="col-md-6" style="background-color">

		  @foreach ($results as $result)
		  
          <div class="form-group">
            <label for="nip">NIP</label>
		    <p class="form-control-static">{{ $result->nip }}</p>
          </div>
          
          <div class="form-group">
            <label for="nama_lengkap">Full Name</label>
		    <p class="form-control-static">{{ $result->nama_lengkap }}</p>
          </div>
          
          <div class="form-group">
            <label for="jenis_kelamin">Gender</label>
		    <p class="form-control-static">{{ $result->jenis_kelamin }}</p>
          </div>
          
          <div class="form-group">
            <label for="no_telp">Telephone Number</label>
		    <p class="form-control-static">{{ $result->no_telp }}</p>
          </div>
          
          <div class="form-group">
            <label for="no_hp">Cellphone Number</label>
		    <p class="form-control-static">{{ $result->no_hp }}</p>
          </div>
		                     
          <div class="form-group">
            <label for="email">Email Address</label>
		    <p class="form-control-static">{{ $result->email }}</p>
          </div>

          <div class="form-group">
            <label for="status_pernikahan">Marital Status</label>
		    <p class="form-control-static">{{ $result->status_pernikahan }}</p>
          </div>

          <div class="form-group">
            <label for="kewarganegaraan">Nationality</label>
		    <p class="form-control-static">{{ $result->kewarganegaraan }}</p>
          </div>

          <div class="form-group">
            <label for="no_ktp">Residence ID number (KTP)</label>
		    <p class="form-control-static">{{ $result->no_ktp }}</p>
          </div>

          <div class="form-group">
            <label for="no_alamat">Address</label>
		    <p class="form-control-static">{{ $result->alamat }}</p>
          </div>

          <div class="form-group">
            <label for="provinsi">Province</label>
		    <p class="form-control-static">{{ $result->provinsi }}. {{ $result->provinsi_nama }}</p>
          </div>
                    
          <div class="form-group">
            <label for="kota">City</label>
		    <p class="form-control-static">{{ $result->kota }}. {{ $result->kota_nama }}</p>
          </div>

          <div class="form-group">
            <label for="kode_pos">Postal Code</label>
		    <p class="form-control-static">{{ $result->kode_pos }}</p>
          </div>

          <div class="form-group">
            <label for="suku">Tribe</label>
		    <p class="form-control-static">{{ $result->suku }}</p>
          </div>

          <div class="form-group">
            <label for="literasi_membaca">Able to Read?</label>
		    <p class="form-control-static">{{ $result->literasi_membaca }}</p>
          </div>
                    
          <div class="form-group">
            <label for="literasi_menulis">Able to Write?</label>
		    <p class="form-control-static">{{ $result->literasi_menulis }}</p>
          </div>
          
          <div class="form-group">
            <label for="pendidikan">Highest Education</label>
		    <p class="form-control-static">{{ $result->pendidikan }}</p>
          </div>

          <div class="form-group">
            <label for="riwayat_penyakit">Sickness History</label>
		    <p class="form-control-static">{{ $result->riwayat_penyakit }}</p>
          </div>
		
          <div class="form-group">
            <label for="bpjs_kesehatan">BPJS Health</label>
		    <p class="form-control-static">{{ $result->bpjs_kesehatan }}</p>
          </div>
          
          <div class="form-group">
            <label for="bpjs_ketenagakerjaan">BPJS Employment</label>
		    <p class="form-control-static">{{ $result->bpjs_ketenagakerjaan }}</p>
          </div>
          
          <div class="form-group">
            <label for="asuransi">Insurance</label>
		    <p class="form-control-static">{{ $result->asurasi }}</p>
          </div>
          
          <div class="form-group">
            <label for="jenis_jabatan">Position Type</label>
		    <p class="form-control-static">{{ $result->jenis_jabatan }}. {{ $result->jenis_jabatan_nama }}</p>
          </div>
                    
          <div class="form-group">
            <label for="jenis_divisi">Division Type</label>
		    <p class="form-control-static">{{ $result->jenis_divisi }}. {{ $result->jenis_divisi_nama }}</p>
          </div>
          
          <div class="form-group">
            <label for="created_at">Start Date</label>
		    <p class="form-control-static">{{ $result->created_at }}</p>
          </div>
		  @endforeach
		  
		          </div>
		          <div class="col-md-6">
		  @foreach ($results_2 as $result_2)		  
          <div class="form-group">
            <label for="nama_pasangan">Spouse's Name</label>
		    <p class="form-control-static">{{ $result_2->nama_pasangan }}</p>
          </div>
          
          <div class="form-group">
            <label for="jumlah_anak">Number of Children</label>
		    <p class="form-control-static">{{ $result_2->jumlah_anak }}</p>
          </div>
          
          <div class="form-group">
            <label for="nama_anak_1">First Child's Name</label>
		    <p class="form-control-static">{{ $result_2->nama_anak_1}}</p>
          </div>
          
          <div class="form-group">
            <label for="nama_anak_2">Second Child's Name</label>
		    <p class="form-control-static">{{ $result_2->nama_anak_2}}</p>
          </div>
          
          <div class="form-group">
            <label for="nama_anak_3">Third Child's Name</label>
		    <p class="form-control-static">{{ $result_2->nama_anak_3}}</p>
          </div>
          
          <div class="form-group">
            <label for="nama_ibu">Mother's Name</label>
		    <p class="form-control-static">{{ $result_2->nama_ibu}}</p>
          </div>
          
          <div class="form-group">
            <label for="nama_ayah">Father's Name</label>
		    <p class="form-control-static">{{ $result_2->nama_ayah}}</p>
          </div>
          
          <div class="form-group">
            <label for="kontak_keluarga_1">Family's Contact 1</label>
		    <p class="form-control-static">{{ $result_2->kontak_keluarga_1 }}</p>
          </div>
          
          <div class="form-group">
            <label for="kontak_keluarga_2">Family's Contact 2</label>
		    <p class="form-control-static">{{ $result_2->kontak_keluarga_2 }}</p>
          </div>
          @endforeach
  
		          </div>
		        </div>
				
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		</section>
		
<script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

</div>
@endsection


           
