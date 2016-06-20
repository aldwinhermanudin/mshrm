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
<div id="form_feedback_ajax"></div>
@foreach ($results as $result)

@if (\Auth::user()->superadmin == true OR $result->superadmin == false)
<form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Account Information</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <!-- PERSONAL INFO-->
          <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="form_1_nip" name="nip" value="{{ $nip }}">

          <div class="form-group">
            <label>NIP</label>
            <p class="form-control-static">{{ $result->nip }}</p>
          </div>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <p class="form-control-static">{{ $result->name }}</p>
          </div>

          <div class="form-group">
            <label>Email</label>
            <p class="form-control-static">{{ $result->email }}</p>
          </div>

          <div class="form-group">
            <label> Superadmin</label>
                @if ($result->superadmin == true)
                <p class="form-control-static"><span class="label label-success">Ya</span></p>
                @else
                <p class="form-control-static"><span class="label label-danger">Tidak</span></p>
                @endif
          </div>

          <div class="form-group">
            <label> Akun dapat mendaftarkan akun lain?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_1 == true)
                <input type="checkbox" name="role_1" id="form_1_role_1" value="true" checked>
                @else
                <input type="checkbox" name="role_1" id="form_1_role_1" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat merubah data akun lain?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_2 == true)
                <input type="checkbox" name="role_2" id="form_1_role_2" value="true" checked>
                @else
                <input type="checkbox" name="role_2" id="form_1_role_2" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat mendaftarkan pegawai?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_3 == true)
                <input type="checkbox" name="role_3" id="form_1_role_3" value="true" checked>
                @else
                <input type="checkbox" name="role_3" id="form_1_role_3" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat merubah data pegawai?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_4 == true)
                <input type="checkbox" name="role_4" id="form_1_role_4" value="true" checked>
                @else
                <input type="checkbox" name="role_4" id="form_1_role_4" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat melaporkan insiden / kecelakaan?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_5 == true)
                <input type="checkbox" name="role_5" id="form_1_role_5" value="true" checked>
                @else
                <input type="checkbox" name="role_5" id="form_1_role_5" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat melaporkan performa kerja pegawai?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_6 == true)
                <input type="checkbox" name="role_6" id="form_1_role_6" value="true" checked>
                @else
                <input type="checkbox" name="role_6" id="form_1_role_6" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat mengajukan cuti pegawai?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_7 == true)
                <input type="checkbox" name="role_7" id="form_1_role_7" value="true" checked>
                @else
                <input type="checkbox" name="role_7" id="form_1_role_7" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat memproses permintaan cuti pegawai?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_8 == true)
                <input type="checkbox" name="role_8" id="form_1_role_8" value="true" checked>
                @else
                <input type="checkbox" name="role_8" id="form_1_role_8" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat memproses permintaan cuti dari pegawai yang berada di bawah pengawasannya?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_9 == true)
                <input type="checkbox" name="role_9" id="form_1_role_9" value="true" checked>
                @else
                <input type="checkbox" name="role_9" id="form_1_role_9" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Akun dapat melakukan ekspor dari database?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_10 == true)
                <input type="checkbox" name="role_10" id="form_1_role_10" value="true" checked>
                @else
                <input type="checkbox" name="role_10" id="form_1_role_10" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <br/>

          <!-- PERSONAL INFO END -->
        </div>
      </div>
    </div>
  </div>

  <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat" style="width: 100%">Save Changes</button>
</form>

<script>
$(document).ready(function(){

  $("#form_1").submit(function(){
      var formData = new FormData($(this)[0]);
      $("#form_feedback_ajax").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
  		$("#form_1_button_submit").prop('disabled', true);
      $.ajax({
          url: '/system/AccountEdit',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            if (data == 'OK')
      			{
      				$("#form_feedback_ajax").empty().html("<div class='callout callout-success'><h5>Sukses!</h5></div>");
      				$("#form_1_button_submit").prop('disabled',false);
      			}
      			else
      			{
      				$("#form_feedback_ajax").empty().html(data);
      				$("#form_1_button_submit").prop('disabled',false);
      			}
          },
          error: function (data) {
            $("#form_feedback_ajax").empty().html("<div class='callout callout-warning'><h5>Terjadi kesalahan, coba lagi dalam waktu dekat.</h5></div>");
    				$("#form_1_button_submit").prop('disabled',false);
          },
          cache: false,
          contentType: false,
          processData: false
      });
      return false;
  });
});
</script>
@else
  <h4>You cannot edit an account with superadmin privilege.</h4>
@endif
@endforeach
<!-- INDONESIA -->
@else
<div id="form_feedback_ajax"></div>
@foreach ($results as $result)
@if (\Auth::user()->superadmin == true OR $result->superadmin == false)
<form id="form_1" method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Account Information</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
          <!-- PERSONAL INFO-->
          <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="form_1_nip" name="nip" value="{{ $nip }}">

          <div class="form-group">
            <label>NIP</label>
            <p class="form-control-static">{{ $result->nip }}</p>
          </div>

          <div class="form-group">
            <label>Full Name</label>
            <p class="form-control-static">{{ $result->name }}</p>
          </div>

          <div class="form-group">
            <label>Email</label>
            <p class="form-control-static">{{ $result->email }}</p>
          </div>

          <div class="form-group">
            <label> Superadmin</label>
                @if ($result->superadmin == true)
                <p class="form-control-static"><span class="label label-success">Yes</span></p>
                @else
                <p class="form-control-static"><span class="label label-danger">No</span></p>
                @endif
          </div>

          <div class="form-group">
            <label> Account can register another account?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_1 == true)
                <input type="checkbox" name="role_1" id="form_1_role_1" value="true" checked>
                @else
                <input type="checkbox" name="role_1" id="form_1_role_1" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can edit another account?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_2 == true)
                <input type="checkbox" name="role_2" id="form_1_role_2" value="true" checked>
                @else
                <input type="checkbox" name="role_2" id="form_1_role_2" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can register employees?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_3 == true)
                <input type="checkbox" name="role_3" id="form_1_role_3" value="true" checked>
                @else
                <input type="checkbox" name="role_3" id="form_1_role_3" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can edit employees?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_4 == true)
                <input type="checkbox" name="role_4" id="form_1_role_4" value="true" checked>
                @else
                <input type="checkbox" name="role_4" id="form_1_role_4" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can report incident / accident?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_5 == true)
                <input type="checkbox" name="role_5" id="form_1_role_5" value="true" checked>
                @else
                <input type="checkbox" name="role_5" id="form_1_role_5" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can report employees' performances?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_6 == true)
                <input type="checkbox" name="role_6" id="form_1_role_6" value="true" checked>
                @else
                <input type="checkbox" name="role_6" id="form_1_role_6" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can request employees' break / day off?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_7 == true)
                <input type="checkbox" name="role_7" id="form_1_role_7" value="true" checked>
                @else
                <input type="checkbox" name="role_7" id="form_1_role_7" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can process all employees' break / day off requests?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_8 == true)
                <input type="checkbox" name="role_8" id="form_1_role_8" value="true" checked>
                @else
                <input type="checkbox" name="role_8" id="form_1_role_8" value="true">
                @endif
                Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can process only employees' break / day off requests under their supervision?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_9 == true)
                <input type="checkbox" name="role_9" id="form_1_role_9" value="true" checked>
                @else
                <input type="checkbox" name="role_9" id="form_1_role_9" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <div class="form-group">
            <label> Account can do exports from the database?</label>
            <br>
            <div class="checkbox">
              <label>
                @if ($result->role_10 == true)
                <input type="checkbox" name="role_10" id="form_1_role_10" value="true" checked>
                @else
                <input type="checkbox" name="role_10" id="form_1_role_10" value="true">
                @endif
                Ya
              </label>
            </div>
          </div>

          <br/>

          <!-- PERSONAL INFO END -->
        </div>
      </div>
    </div>
  </div>

  <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat" style="width: 100%">Save Changes</button>
</form>

<script>
$(document).ready(function(){

  $("#form_1").submit(function(){
      var formData = new FormData($(this)[0]);
      $("#form_feedback_ajax").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
  		$("#form_1_button_submit").prop('disabled', true);
      $.ajax({
          url: '/system/AccountEdit',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            if (data == 'OK')
      			{
      				$("#form_feedback_ajax").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
      				$("#form_1_button_submit").prop('disabled',false);
      			}
      			else
      			{
      				$("#form_feedback_ajax").empty().html(data);
      				$("#form_1_button_submit").prop('disabled',false);
      			}
          },
          error: function (data) {
            $("#form_feedback_ajax").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
    				$("#form_1_button_submit").prop('disabled',false);
          },
          cache: false,
          contentType: false,
          processData: false
      });
      return false;
  });
});
</script>
@else
  <h4>You cannot edit an account with superadmin privilege.</h4>
@endif
@endforeach
@endif
