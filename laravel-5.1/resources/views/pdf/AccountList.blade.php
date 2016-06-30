<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<h2>List of Account / Daftar Akun</h2>
<h4>PT. Mitra Siaga - Timestamp: {{ $date }}</h4>
<hr>
<table class="pure-table" style="width:100%;font-size:12px;">
  <thead>
    <tr>
      <th>NIP</th>
      <th>Name</th>
      <th>Email</th>
      <th>Superadmin</th>
      <th>R_1</th>
      <th>R_2</th>
      <th>R_3</th>
      <th>R_4</th>
      <th>R_5</th>
      <th>R_6</th>
      <th>R_7</th>
      <th>R_8</th>
      <th>R_9</th>
      <th>R_10</th>
      <th>R_11</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($results as $result)
    <tr>
      <th>{{ $result->nip }}</th>
      <th>{{ $result->name }}</th>
      <th>{{ $result->email }}</th>
      <th>{{ $result->superadmin }}</th>
      <th>{{ $result->role_1 }}</th>
      <th>{{ $result->role_2 }}</th>
      <th>{{ $result->role_3 }}</th>
      <th>{{ $result->role_4 }}</th>
      <th>{{ $result->role_5 }}</th>
      <th>{{ $result->role_6 }}</th>
      <th>{{ $result->role_7 }}</th>
      <th>{{ $result->role_8 }}</th>
      <th>{{ $result->role_9 }}</th>
      <th>{{ $result->role_10 }}</th>
      <th>{{ $result->role_11 }}</th>
    </tr>
    @endforeach
  </tbody>
</table>
