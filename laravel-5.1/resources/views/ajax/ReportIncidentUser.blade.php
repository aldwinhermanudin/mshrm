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
@foreach($results as $result)
<div style="text-align:center">
  <img style="width:175px;" src="{{asset('/assets/uploads/images')}}/{{ $nip }}" class="img-circle" alt="No Profile Picture."/>
</div>
<br>

<table style="width:100%" class="table table-striped">
 <tr>
   <td>NIP</td>
   <td>{{ $result->nip }}</td>
 </tr>
 <tr>
   <td>Nama Lengkap</td>
   <td>{{ $result->nama_lengkap }}</td>
 </tr>
 <tr>
   <td>Nomor Telefon</td>
   <td>{{ $result->no_hp }}</td>
 </tr>
 <tr>
   <td>Jenis Posisi</td>
   <td>{{ $result->jenis_jabatan_nama }}</td>
 </tr>
 <tr>
   <td>Jenis Lokasi</td>
   <td>{{ $result->jenis_divisi_nama }}</td>
 </tr>
</table>
@endforeach
@else
@foreach($results as $result)
<div style="text-align:center">
  <img style="width:175px;" src="{{asset('/assets/uploads/images')}}/{{ $nip }}" class="img-circle" alt="No Profile Picture."/>
</div>
<br>

<table style="width:100%" class="table table-striped">
 <tr>
   <td>NIP</td>
   <td>{{ $result->nip }}</td>
 </tr>
 <tr>
   <td>Full Name</td>
   <td>{{ $result->nama_lengkap }}</td>
 </tr>
 <tr>
   <td>Phone Number</td>
   <td>{{ $result->no_hp }}</td>
 </tr>
 <tr>
   <td>Position Type</td>
   <td>{{ $result->jenis_jabatan_nama }}</td>
 </tr>
 <tr>
   <td>Division Type</td>
   <td>{{ $result->jenis_divisi_nama }}</td>
 </tr>
</table>
@endforeach
@endif
