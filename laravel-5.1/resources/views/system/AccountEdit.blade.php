@extends('core.app')

@section('content')


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
IND
@else
<link href="{{ asset('/A/css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.css') }}">

<title>2016 mshrm ⋅ Edit Account</title>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Account
      <small>Edit Accounts</small>
    </h1>

    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Edit Accounts</li>
    </ol>
  </section>

  <section class="content">
    <div id="form_feedback"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-body">
            <!-- TABLE STARTS -->
            <table id="table_1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>NIP</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Superadmin</th>
                  <th>Last Activity</th>
                  <th>Edit</th>
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
                </tr>
                @else
                @foreach($results as $result)
                <tr>
                  <td>{{ $result->nip }}</td>
                  <td>{{ $result->name }}</td>
                  <td>{{ $result->email }}</td>
                  <td>
                    @if($result->superadmin)
                    <span class="label label-success">Yes</span>
                    @else
                    <span class="label label-danger">No</span>
                    @endif
                  </td>
                  <td>{{ $result->updated_at }}</td>
                  <td><a href="#" data-toggle="modal" data-target="#general_modal" onclick="detailAccount({{ $result->nip }})"><span class="glyphicon glyphicon-edit"></span></a></td>
                  <td class="danger"><a href="#" onclick="eraseAccount({{ $result->nip }})"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                @endforeach
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>NIP</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Superadmin</th>
                  <th>Last Activity</th>
                  <th>Edit</th>
                  <th class="danger">Delete</th>
                </tr>
              </tfoot>
            </table>
            <!-- TABLE ENDS -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      $("#table_1").DataTable();
    });

    function detailAccount(nip)
    {
      console.log("Detail Account id: " + nip);
      $("#modal_content").empty().load("/system/AccountDetail/" + nip);
    }

    function eraseAccount(nip)
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

    $(document).ready(function(){
      console.log("Ready");
    });
  </script>
</div>
@endif

@endsection
