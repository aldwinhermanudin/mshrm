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
  <label>Kota</label>
  <select class="form-control" id="form_1_kota" name="kota" placeholder="city (kota)">
  @foreach ($results as $result)
    <option value="{{ $result->id }}">{{ $result->id }}. {{ $result->name }}</option>
  @endforeach
  </select>
</div>
@else
<div class="form-group">
  <label>City (Kota)</label>
  <select class="form-control" id="form_1_kota" name="kota" placeholder="city (kota)">
  @foreach ($results as $result)
    <option value="{{ $result->id }}">{{ $result->id }}. {{ $result->name }}</option>
  @endforeach
  </select>
</div>
@endif
