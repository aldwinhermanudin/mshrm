@extends('core.app')

@section('content')
<link href="{{ asset('/A/css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.css') }}">
<title>2016 mshrm ⋅ Employee List</title>


      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Employee List
            <small>List of Employees.</small>
          </h1>
          
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Employee list</li>
          </ol>
        </section>
        
        <section class="content">
			
		@if(session()->has('messages'))
		  <div class="callout callout-success"><h5>{{ session('messages') }}</h5></div>
	    @endif

              <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NIP</th>
                        <th>Full Name</th>
                        <th>City</th>
                        <th>Position</th>
                        <th>Division</th>
                        <th>LWS</th>
                        <th>LDO</th>
                        <th>Details</th>
                        <th class="danger">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
					  @if (empty($results))
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  <td>Empty</td>
					  @else
					  @foreach($results as $result)
                      <tr>
                        <td>{{ $result->nip }}</td>
                        <td>{{ $result->nama_lengkap}}</td>
                        <td>{{ $result->kota_nama }}</td>
                        <td>{{ $result->jenis_jabatan_nama }}</td>
                        <td>{{ $result->jenis_divisi_nama }}</td>
                        <td>-- : --</td>
                        <td>--</td>
                        <td><a href="{{ url('/admin/UserDetail') }}/{{ $result->nip }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td class="danger"><a href="{{ url('/admin/UserErase') }}/{{ $result->nip }}"><span class="glyphicon glyphicon-remove"></span></a></td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>NIP</th>
                        <th>Full Name</th>
                        <th>City</th>
                        <th>Position</th>
                        <th>Division</th>
                        <th>Last Work Session</th>
                        <th>Last Day Off</th>
                        <th>Details</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		</section>
		
<script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

</div>
@endsection


           
