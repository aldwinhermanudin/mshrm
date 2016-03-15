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
      </tr>
    </tfoot>
  </table>
</div>
</div>
</section>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="general_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modal_content">
        Detail
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
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
</script>
</div>
@endsection
