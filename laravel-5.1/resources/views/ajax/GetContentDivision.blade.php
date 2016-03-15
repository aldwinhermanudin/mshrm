<div class="form-group">
  <label>Division Type</label>
  <select class="form-control" id="form_1_jenis_divisi" name="jenis_divisi" placeholder="division type">
  @foreach ($results as $result)
    <option value="{{ $result->kode_divisi }}">{{ $result->kode_divisi }}. {{ $result->nama_divisi }}</option>
  @endforeach
  </select>
</div>
