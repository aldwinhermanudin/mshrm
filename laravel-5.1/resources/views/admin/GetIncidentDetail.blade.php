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
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Detil Kejadian</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

      @foreach ($results as $result)
        <div class="box-body">

          <div>
            <img style="width:50%; text-align:center;" src="{{asset('/assets/uploads/incidents')}}/{{ $result->url }}" alt="Gambar tidak dapat dimuat."/>
          </div>
          <hr>

          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Jenis Kejadian</label>
            <p class="form-control-static">{{ $result->tipe }}</p>
          </div>

          <div class="form-group">
            <label>Deskripsi Kejadian</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->deskripsi }}</textarea>
          </div>

          <div class="form-group">
            <label>Lokasi Kejadian</label>
            <input type="text" class="form-control" value="{{ $result->tempat_terjadi }}" disabled>
          </div>

          <div class="form-group">
            <label>Waktu Kejadian</label>
            <input type="text" class="form-control" value="{{ $result->waktu_terjadi }}" disabled>
          </div>

          <div class="form-group">
            <label>Waktu Dilaporkan</label>
            <input type="text" class="form-control" value="{{ $result->waktu_laporan }}" disabled>
          </div>

          <div class="form-group">
            <label>Akun yang digunakan Untuk Melapor</label>
            <input type="text" class="form-control" value="{{ $result->pelapor_akun }}" disabled>
          </div>

        </div>
      @endforeach
    </div>
  </div>
</div>
@else
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Event Detail</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

      @foreach ($results as $result)
        <div class="box-body">

          <div>
            <img style="width:50%; text-align:center;" src="{{asset('/assets/uploads/incidents')}}/{{ $result->url }}" alt="Picture can't be loaded."/>
          </div>

          <hr>

          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Type</label>
            <p class="form-control-static">{{ $result->tipe }}</p>
          </div>

          <div class="form-group">
            <label>Event Description</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->deskripsi }}</textarea>
          </div>

          <div class="form-group">
            <label>Event Location</label>
            <input type="text" class="form-control" value="{{ $result->tempat_terjadi }}" disabled>
          </div>

          <div class="form-group">
            <label>Event Time</label>
            <input type="text" class="form-control" value="{{ $result->waktu_terjadi }}" disabled>
          </div>

          <div class="form-group">
            <label>Report Time</label>
            <input type="text" class="form-control" value="{{ $result->waktu_laporan }}" disabled>
          </div>

          <div class="form-group">
            <label>Reporter's Account</label>
            <input type="text" class="form-control" value="{{ $result->pelapor_akun }}" disabled>
          </div>

        </div>
      @endforeach

    </div>
  </div>
</div>
@endif
