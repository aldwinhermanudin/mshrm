@foreach($results as $result)
<div style="text-align:center">
  <img style="width:175px;" src="{{asset('/assets/uploads/images')}}/{{ $nip }}" class="img-circle" alt="No Profile Picture."/>
</div>
<br>

<table style="width:100%" class="table table-striped">
 <tr>
   <td>nip</td>
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
