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
<div class="form-group">
  <label>Jenis Lokasi</label>
  <select class="form-control" id="form_1_jenis_divisi" name="jenis_divisi" placeholder="division type">
  @foreach ($results as $result)
    <option value="{{ $result->kode_divisi }}">{{ $result->kode_divisi }}. {{ $result->nama_divisi }}</option>
  @endforeach
  </select>
</div>
@else
<div class="form-group">
  <label>Location Type</label>
  <select class="form-control" id="form_1_jenis_divisi" name="jenis_divisi" placeholder="division type">
  @foreach ($results as $result)
    <option value="{{ $result->kode_divisi }}">{{ $result->kode_divisi }}. {{ $result->nama_divisi }}</option>
  @endforeach
  </select>
</div>
@endif
