@extends('core.app')

@section('content')
<link href="{{ asset('/A/css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.css') }}">
<title>2016 mshrm ⋅ Employee List</title>
<input type="hidden" id="general_token" name="_token" value="{{ csrf_token() }}">

<div class="content-wrapper">
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
    <div id="page_feedback"></div>
    <div class="box">
      <div class="box-header">
      </div>
      <div class="box-body">
        <table id="table_1" class="table table-bordered table-striped">
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
            <tr>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
            </tr>
            @else
            @foreach($results as $result)
            <tr id="content_{{ $result->nip }}">
              <td>{{ $result->nip }}</td>
              <td>{{ $result->nama_lengkap}}</td>
              <td>{{ $result->kota_nama }}</td>
              <td>{{ $result->jenis_jabatan_nama }}</td>
              <td>{{ $result->jenis_divisi_nama }}</td>
              <td>-- : --</td>
              <td>--</td>
              <td><a href="#" data-toggle="modal" data-target="#general_modal" onclick="detailUser({{ $result->nip }})"><span class="glyphicon glyphicon-edit"></span></a></td>
              <td class="danger"><a href="#" onclick="eraseUser({{ $result->nip }})"><span class="glyphicon glyphicon-remove"></span></a></td>
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
              <th>Delete</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>

  <section class="content-header">
    <h1>
      Incidents
      <small>List of Reported Incidents.</small>
    </h1>
  </section>

  <section class="content">
    <div id="page_feedback"></div>
    <div class="box">
      <div class="box-header">
      </div>
      <div class="box-body">
        <table id="table_2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NIP</th>
              <th>Incident Location</th>
              <th>Incident Time</th>
              <th>Report Time</th>
              <th>Reporter's Account</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            @if (empty($results))
            <tr>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
              <td>Empty</td>
            </tr>
            @else
            @foreach($results_2 as $result_2)
            <tr id="content_2_{{ $result_2->id }}">
              <td>{{ $result_2->nip }}</td>
              <td>{{ $result_2->tempat_terjadi }}</td>
              <td>{{ $result_2->waktu_terjadi }}</td>
              <td>{{ $result_2->waktu_laporan }}</td>
              <td>{{ $result_2->pelapor_akun }}</td>
              <td><a href="#" data-toggle="modal" data-target="#general_modal" onclick="detailIncident({{ $result_2->id }})"><span class="glyphicon glyphicon-edit"></span></a></td>
            </tr>
            @endforeach
            @endif
          </tbody>
          <tfoot>
            <tr>
              <th>NIP</th>
              <th>Incident Location</th>
              <th>Incident Time</th>
              <th>Report Time</th>
              <th>Reporter's Account</th>
              <th>Details</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>

  <section class="content-header">
    <h1>
      Performance Record
      <small>Recorded Employee's Performances.</small>
    </h1>
  </section>


    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
          <table id="table_3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Task Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              @if (empty($results))
              <tr>
                <td>Empty</td>
                <td>Empty</td>
                <td>Empty</td>
                <td>Empty</td>
                <td>Empty</td>
              </tr>
              @else
              @foreach($results_3 as $result_3)
              <tr id="content_3_{{ $result_3->id }}">
                <td>{{ $result_3->nip }}</td>
                <td>{{ $result_3->nama_penugasan }}</td>
                <td>{{ $result_3->tanggal_mulai }}</td>
                <td>{{ $result_3->tanggal_selesai }}</td>
                <td><a href="#" data-toggle="modal" data-target="#general_modal" onclick="detailPerformance({{ $result_3->id }})"><span class="glyphicon glyphicon-edit"></span></a></td>
              </tr>
              @endforeach
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th>NIP</th>
                <th>Task Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Details</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>

<script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#table_1").DataTable();
  });

  $(function () {
    $("#table_2").DataTable();
  });

  $(function () {
    $("#table_3").DataTable();
  });

  function eraseUser(nip)
  {
    $("#page_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
    $.post("/admin/UserErase",
    {
      _token: $("#general_token").val(),
      nip: nip,
    },
    function(data,status){
      if (data == 'OK')
      {
        $("#page_feedback").empty().html("<div class='callout callout-success'><h5>Deleted.</h5></div>");
        $("#content_" + nip).empty().html("<td class='danger'>" + nip + "</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td><td class='danger'>Deleted</td>");
      }
      else
      {
        $("#page_feedback").empty().html(data);
      }
    });
  }

  function detailUser(nip)
  {
    $("#modal_content").empty().load("/admin/UserDetail/" + nip);
  }

  function detailIncident(id)
  {
    $("#modal_content").empty().load("/admin/IncidentDetail/" + id);
  }

  function detailPerformance(id)
  {
    $("#modal_content").empty().load("/admin/PerformanceDetail/" + id);
  }
</script>
</div>
@endsection
