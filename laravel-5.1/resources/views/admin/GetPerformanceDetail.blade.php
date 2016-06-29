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
        <h3 class="box-title">Detil Catatan Kinerja Pegawai</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

      @foreach ($results as $result)

        <div class="box-body">
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Nama Tugas</label>
            <input type="text" class="form-control" value="{{ $result->nama_penugasan }}" disabled>
          </div>

          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->keterangan }}</textarea>
          </div>

          <div class="form-group">
            <label>Catatan Pada Performa</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->catatan_kinerja }}</textarea>
          </div>

          <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="text" class="form-control" value="{{ $result->tanggal_mulai }}" disabled>
          </div>

          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="text" class="form-control" value="{{ $result->tanggal_selesai }}" disabled>
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
        <h3 class="box-title">Performance Record Detail</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

      @foreach ($results as $result)

        <div class="box-body">
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Task Name</label>
            <input type="text" class="form-control" value="{{ $result->nama_penugasan }}" disabled>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->keterangan }}</textarea>
          </div>

          <div class="form-group">
            <label>Note on Performance</label>
            <textarea class="form-control" rows="3" placeholder="address" disabled>{{ $result->catatan_kinerja }}</textarea>
          </div>

          <div class="form-group">
            <label>Start Date</label>
            <input type="text" class="form-control" value="{{ $result->tanggal_mulai }}" disabled>
          </div>

          <div class="form-group">
            <label>End Date</label>
            <input type="text" class="form-control" value="{{ $result->tanggal_selesai }}" disabled>
          </div>

        </div>
      @endforeach
    </div>
  </div>
</div>
@endif
