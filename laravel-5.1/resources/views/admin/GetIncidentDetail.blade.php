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
            <label>Incident Description</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->deskripsi }}</textarea>
          </div>

          <div class="form-group">
            <label>Incident Location</label>
            <input type="text" class="form-control" value="{{ $result->tempat_terjadi }}" disabled>
          </div>

          <div class="form-group">
            <label>Incident Time</label>
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
