<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<h2>List of Employees</h2>
<h4>PT. Mitra Siaga - Timestamp: {{ $date }}</h4>
<hr>
<table class="pure-table" style="width:100%;font-size:12px;">
  <thead>
    <tr>
      <th>NIP</th>
      <th>Jabatan</th>
      <th>Divisi</th>
      <th>Nama Lengkap</th>
      <th>Jenis Kelamin</th>
      <th>N.HP</th>
      <th>Status.P</th>
      <th>Kewar.</th>
      <th>Alamat</th>
      <th>Kota, Provinsi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($results as $result)
    <tr>
      <th>{{ $result->nip }}</th>
      <th>{{ $result->jenis_jabatan }}. {{ $result->jenis_jabatan_nama }}</th>
      <th>{{ $result->jenis_divisi }}, {{ $result->jenis_divisi_nama }}</th>
      <th>{{ $result->nama_lengkap }}</th>
      <th>{{ $result->jenis_kelamin }}</th>
      <th>{{ $result->no_hp }}</th>
      <th>{{ $result->status_pernikahan }}</th>
      <th>{{ $result->kewarganegaraan }}</th>
      <th>{{ $result->alamat }}</th>
      <th>{{ $result->kota_nama }}, {{ $result->provinsi_nama }}</th>
    </tr>
    @endforeach
  </tbody>
</table>
