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
@foreach ($results as $result)
<div class="row">
  <div class="col-md-6" style="text-align: center">
    <p>Pegawai</p>
    <img style="width:100px;" src="{{asset('/assets/uploads/images')}}/{{ $result->nip }}" class="img-circle" alt="Gambar tidak dapat dimuat."/>
  </div>
  <div class="col-md-6" style="text-align: center">
    <p>Pegawai yang menggantikan</p>
    <img style="width:100px;" src="{{asset('/assets/uploads/images')}}/{{ $result->pengganti_nip }}" class="img-circle" alt="Gambar tidak dapat dimuat."/>
  </div>
</div>
@endforeach
<hr>
<div id="form_feedback"></div>
@foreach ($results as $result)
  <div class="row">
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Detil Permintaan</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <!-- PERSONAL INFO-->
          <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label>Status Permintaan</label>
            <input type="text" class="form-control" value="{{ $result->status_cuti }}" disabled>
          </div>

          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" class="form-control" value="{{ $result->nama_lengkap }}" disabled>
          </div>

          <div class="form-group">
            <label>NIP Pegawai Yang Menggantikan</label>
            <input type="text" class="form-control" value="{{ $result->pengganti_nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Nama Pegawai Yang Menggantikan</label>
            <input type="text" class="form-control" value="{{ $result->pengganti_nama }}" disabled>
          </div>

          <div class="form-group">
            <label>NIP Supervisor</label>
            <input type="text" class="form-control" value="{{ $result->supervisor_nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Nama Supervisor</label>
            <input type="text" class="form-control" value="{{ $result->supervisor_nama_akun }}" disabled>
          </div>

          <div class="form-group">
            <label>NIP Penyetuju</label>
            <input type="text" class="form-control" value="{{ $result->penyetuju_nip }}" disabled>
          </div>

          <div class="form-group">
            <label>Nama Penyetuju</label>
            <input type="text" class="form-control" value="{{ $result->penyetuju_nama_akun }}" disabled>
          </div>

          <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="text" class="form-control" value="{{ $result->tanggal_mulai }}" disabled>
          </div>

          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="text" class="form-control" value="{{ $result->tanggal_selesai }}" disabled>
          </div>

          <div class="form-group">
            <label>Alasan</label>
            <textarea class="form-control" rows="3" disabled>{{ $result->alasan_cuti }}</textarea>
          </div>

          <div class="form-group">
            <label>Timestamp Permintaan Diajukan</label>
            <input type="text" class="form-control" value="{{ $result->waktu_pengajuan }}" disabled>
          </div>

          <div class="form-group">
            <label>Timestamp Permintaan Disetujui</label>
            <input type="text" class="form-control" value="{{ $result->waktu_disetujui }}" disabled>
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Catatan Cuti</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <table id="table_1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Status</th>
                <!--<th>Employee's Name</th>-->
                <th>Nama Pegawai Yang Menggantikan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
              </tr>
            </thead>
            <tbody>
              @foreach($results_2 as $result_2)
              <tr>
                <td>{{ $result_2->status_cuti }}</td>
                <!--<td>{{ $result_2->nama_lengkap }}</td>-->
                <td>{{ $result_2->pengganti_nama }}</td>
                <td>{{ $result_2->tanggal_mulai }}</td>
                <td>{{ $result_2->tanggal_selesai }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <button id="form_1_button_edit" class="btn btn-success btn-flat" onclick="processBreak({{ $result->id }}, 'APPROVED')">Setujui Permintaan</button>
  <button id="form_1_button_edit" class="btn btn-warning btn-flat" onclick="processBreak({{ $result->id }}, 'DENIED')">Tolak Permintaan</button>
@endforeach
<script>
  function processBreak(id, break_status) {
    $("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
    $.post("/admin/ProcessBreak",
    {
      _token: $("#_token").val(),
      id: id,
      status: break_status,
    },
    function(data,status){
      if (data == 'OK')
      {
        $("#form_feedback").empty().html("<div class='callout callout-success'><h5>Sukses.</h5></div>");
        $("#break_content_" + id).empty().text(break_status);
      }
      else
      {
        $("#form_feedback").empty().html(data);
      }
    });
  }
</script>
@else
  @foreach ($results as $result)
  <div class="row">
    <div class="col-md-6" style="text-align: center">
      <p>Employee</p>
      <img style="width:100px;" src="{{asset('/assets/uploads/images')}}/{{ $result->nip }}" class="img-circle" alt="No Profile Picture."/>
    </div>
    <div class="col-md-6" style="text-align: center">
      <p>Substitute</p>
      <img style="width:100px;" src="{{asset('/assets/uploads/images')}}/{{ $result->pengganti_nip }}" class="img-circle" alt="No Profile Picture."/>
    </div>
  </div>
  @endforeach
  <hr>
  <div id="form_feedback"></div>
  @foreach ($results as $result)
    <div class="row">
      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Request Detail</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>

          <div class="box-body">
            <!-- PERSONAL INFO-->
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label>Request Status</label>
              <input type="text" class="form-control" value="{{ $result->status_cuti }}" disabled>
            </div>

            <div class="form-group">
              <label>NIP</label>
              <input type="text" class="form-control" value="{{ $result->nip }}" disabled>
            </div>

            <div class="form-group">
              <label>Employee's Name</label>
              <input type="text" class="form-control" value="{{ $result->nama_lengkap }}" disabled>
            </div>

            <div class="form-group">
              <label>Substitute's NIP</label>
              <input type="text" class="form-control" value="{{ $result->pengganti_nip }}" disabled>
            </div>

            <div class="form-group">
              <label>Substitute's Name</label>
              <input type="text" class="form-control" value="{{ $result->pengganti_nama }}" disabled>
            </div>

            <div class="form-group">
              <label>Supervisor's NIP</label>
              <input type="text" class="form-control" value="{{ $result->supervisor_nip }}" disabled>
            </div>

            <div class="form-group">
              <label>Supervisor's Name</label>
              <input type="text" class="form-control" value="{{ $result->supervisor_nama_akun }}" disabled>
            </div>

            <div class="form-group">
              <label>Approver's NIP</label>
              <input type="text" class="form-control" value="{{ $result->penyetuju_nip }}" disabled>
            </div>

            <div class="form-group">
              <label>Approver's Name</label>
              <input type="text" class="form-control" value="{{ $result->penyetuju_nama_akun }}" disabled>
            </div>

            <div class="form-group">
              <label>Start Date</label>
              <input type="text" class="form-control" value="{{ $result->tanggal_mulai }}" disabled>
            </div>

            <div class="form-group">
              <label>End Date</label>
              <input type="text" class="form-control" value="{{ $result->tanggal_selesai }}" disabled>
            </div>

            <div class="form-group">
              <label>Reason</label>
              <textarea class="form-control" rows="3" disabled>{{ $result->alasan_cuti }}</textarea>
            </div>

            <div class="form-group">
              <label>Request Timestamp</label>
              <input type="text" class="form-control" value="{{ $result->waktu_pengajuan }}" disabled>
            </div>

            <div class="form-group">
              <label>Approval Timestamp</label>
              <input type="text" class="form-control" value="{{ $result->waktu_disetujui }}" disabled>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">History</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>

          <div class="box-body">
            <table id="table_1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Status</th>
                  <!--<th>Employee's Name</th>-->
                  <th>Substitute's Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($results_2 as $result_2)
                <tr>
                  <td>{{ $result_2->status_cuti }}</td>
                  <!--<td>{{ $result_2->nama_lengkap }}</td>-->
                  <td>{{ $result_2->pengganti_nama }}</td>
                  <td>{{ $result_2->tanggal_mulai }}</td>
                  <td>{{ $result_2->tanggal_selesai }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <button id="form_1_button_edit" class="btn btn-success btn-flat" onclick="processBreak({{ $result->id }}, 'APPROVED')">Approve</button>
    <button id="form_1_button_edit" class="btn btn-warning btn-flat" onclick="processBreak({{ $result->id }}, 'DENIED')">Deny</button>
  @endforeach
  <script>
    function processBreak(id, break_status) {
      $("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
      $.post("/admin/ProcessBreak",
      {
        _token: $("#_token").val(),
        id: id,
        status: break_status,
      },
      function(data,status){
        if (data == 'OK')
        {
          $("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success.</h5></div>");
          $("#break_content_" + id).empty().text(break_status);
        }
        else
        {
          $("#form_feedback").empty().html(data);
        }
      });
    }
  </script>
@endif
