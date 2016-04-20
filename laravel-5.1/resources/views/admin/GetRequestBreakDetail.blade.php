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
          <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

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
                <th>Employee's Name</th>
                <th>Substitute's Name</th>
                <th>Start Date</th>
                <th>End Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($results_2 as $result_2)
              <tr>
                <td>{{ $result_2->status_cuti }}</td>
                <td>{{ $result_2->nama_lengkap }}</td>
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

  <button type="submit" id="form_1_button_edit" class="btn btn-success btn-flat">Approve</button>
  <button type="submit" id="form_1_button_edit" class="btn btn-warning btn-flat">Deny</button>
@endforeach
