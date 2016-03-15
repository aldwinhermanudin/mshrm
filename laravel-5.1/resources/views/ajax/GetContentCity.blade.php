<div class="form-group">
  <label>City (Kota)</label>
  <select class="form-control" id="form_1_kota" name="kota" placeholder="city (kota)">
  @foreach ($results as $result)
    <option value="{{ $result->id }}">{{ $result->id }}. {{ $result->name }}</option>
  @endforeach
  </select>
</div>
