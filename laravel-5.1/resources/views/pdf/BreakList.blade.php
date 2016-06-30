<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<h2>List of Break Request / Daftar Permintaan Cuti</h2>
<h4>PT. Mitra Siaga - Timestamp: {{ $date }}</h4>
<hr>
<table class="pure-table" style="width:100%;font-size:12px;">
  <thead>
    <tr>
      <th>Status</th>
      <th>Name</th>
      <th>NIP</th>
      <th>Substitute</th>
      <th>NIP</th>
      <th>Start</th>
      <th>End</th>
      <th>Approved By</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($results as $result)
    <tr>
      <th>{{ $result->status_cuti }}</th>
      <th>{{ $result->nama_lengkap }}</th>
      <th>{{ $result->nip }}</th>
      <th>{{ $result->pengganti_nama }}</th>
      <th>{{ $result->pengganti_nip }}</th>
      <th>{{ $result->tanggal_mulai }}</th>
      <th>{{ $result->tanggal_selesai }}</th>
      <th>{{ $result->penyetuju_nama_akun }}</th>
    </tr>
    @endforeach
  </tbody>
</table>
