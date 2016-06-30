<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<h2>List of Incident and Accident / Daftar Insiden dan Kecelakaan</h2>
<h4>PT. Mitra Siaga - Timestamp: {{ $date }}</h4>
<hr>
<table class="pure-table" style="width:100%;font-size:12px;">
  <thead>
    <tr>
      <th>NIP</th>
      <th>Type</th>
      <th>Desription</th>
      <th>Location</th>
      <th>Timestamp</th>
      <th>Reported By</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($results as $result)
    <tr>
      <th>{{ $result->nip }}</th>
      <th>{{ $result->tipe }}</th>
      <th>{{ $result->deskripsi }}</th>
      <th>{{ $result->tempat_terjadi }}</th>
      <th>{{ $result->waktu_terjadi }}</th>
      <th>{{ $result->pelapor_akun }}</th>
    </tr>
    @endforeach
  </tbody>
</table>
