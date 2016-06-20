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
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<title>2016 mshrm ⋅ Daftarkan Akun</title>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftarkan Akun
            <small>Daftarkan sebuah akun untuk mengakses MSHRM</small>
          </h1>

          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Daftarkan Akun</li>
          </ol>
        </section>

        <section class="content">
          <div id="form_feedback"></div>

      	  <div class="row">
              <div class="col-md-12">
                <div class="box box-info">

                  <form id="form_1" method="post" autocomplete="off">
                    <div class="box-header with-border">
                      <h3 class="box-title">Daftarkan Akun ⋅ <span class="label label-info">Masukkan data secara manual</span></h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                    <div class="box-body">
                      <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                      <div id="form_1_user_feedback"></div>

                      <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" id="form_1_nip" name="nip" placeholder="nip">
                      </div>

                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" id="form_1_name" name="name" placeholder="Nama Lengkap">
                      </div>

                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="form_1_email" name="email" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label>Kata Sandi</label>
                        <p>Otomatis</p>
                      </div>

                      <div class="form-group">
                        <label> Buat akun menjadi superadmin?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="superadmin" id="form_1_superadmin" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat mendaftarkan akun lain?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_1" id="form_1_role_1" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat merubah data akun lain?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_2" id="form_1_role_2" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat mendaftarkan pegawai?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_3" id="form_1_role_3" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat merubah data pegawai?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_4" id="form_1_role_4" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat melaporkan insiden / kecelakaan?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_5" id="form_1_role_5" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat melaporkan performa kerja pegawai?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_6" id="form_1_role_6" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat mengajukan cuti pegawai?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_7" id="form_1_role_7" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat memproses permintaan cuti pegawai?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_8" id="form_1_role_8" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat memproses permintaan cuti dari pegawai yang berada di bawah pengawasannya?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_9" id="form_1_role_9" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Akun dapat melakukan ekspor dari database?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_10" id="form_1_role_10" value="true">
                            Ya
                          </label>
                        </div>
                      </div>

                    </div>

                    <div class="box-footer">
                      <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat">Submit</button>
                      <button type="reset" id="form_1_button_reset" class="btn btn-info btn-flat">Reset</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </section>
<script>
  $(document).ready(function(){

    $("#form_1").submit(function(){
      $("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
        var formData = new FormData($(this)[0]);
        $("#form_1_button_submit").prop('disabled',true);
        $.ajax({
            url: '/system/AccountRegister',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
              if (data == 'OK')
        			{
        				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Sukses!</h5></div>");
        				$("#form_1_button_submit").prop('disabled',false);
        			}
        			else
        			{
        				$("#form_feedback").empty().html(data);
        				$("#form_1_button_submit").prop('disabled',false);
        			}
            },
            error: function (data) {
              $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Terjadi kesalahan, coba lagi dalam waktu dekat.</h5></div>");
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
</div>
@else
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<title>2016 mshrm ⋅ Register Account</title>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Register Account
            <small>Register an Account</small>
          </h1>

          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Register Account</li>
          </ol>
        </section>

        <section class="content">
          <div id="form_feedback"></div>

      	  <div class="row">
              <div class="col-md-12">
                <div class="box box-info">

                  <form id="form_1" method="post" autocomplete="off">
                    <div class="box-header with-border">
                      <h3 class="box-title">Register Account ⋅ <span class="label label-info">Manually insert data</span></h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                    <div class="box-body">
                      <input type="hidden" id="form_1_token" name="_token" value="{{ csrf_token() }}">

                      <div id="form_1_user_feedback"></div>

                      <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" id="form_1_nip" name="nip" placeholder="nip">
                      </div>

                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="form_1_name" name="name" placeholder="Full Name">
                      </div>

                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="form_1_email" name="email" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <p>Auto</p>
                      </div>

                      <div class="form-group">
                        <label> Make account as a superadmin?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="superadmin" id="form_1_superadmin" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can register another account?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_1" id="form_1_role_1" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can edit another account?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_2" id="form_1_role_2" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can register employees?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_3" id="form_1_role_3" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can edit employees?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_4" id="form_1_role_4" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can report incident / accident?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_5" id="form_1_role_5" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can report employees' performances?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_6" id="form_1_role_6" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can request employees' break / day off?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_7" id="form_1_role_7" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can process all employees' break / day off requests?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_8" id="form_1_role_8" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can process only employees' break / day off requests under their supervision?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_9" id="form_1_role_9" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label> Account can do exports from the database?</label>
                        <br>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="role_10" id="form_1_role_10" value="true">
                            Yes
                          </label>
                        </div>
                      </div>

                    </div>

                    <div class="box-footer">
                      <button type="submit" id="form_1_button_submit" class="btn btn-info btn-flat">Submit</button>
                      <button type="reset" id="form_1_button_reset" class="btn btn-info btn-flat">Reset</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </section>
<script>
  $(document).ready(function(){

    $("#form_1").submit(function(){
      $("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
        var formData = new FormData($(this)[0]);
        $("#form_1_button_submit").prop('disabled',true);
        $.ajax({
            url: '/system/AccountRegister',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
              if (data == 'OK')
        			{
        				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success!</h5></div>");
        				$("#form_1_button_submit").prop('disabled',false);
        			}
        			else
        			{
        				$("#form_feedback").empty().html(data);
        				$("#form_1_button_submit").prop('disabled',false);
        			}
            },
            error: function (data) {
              $("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
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
</div>
@endif

@endsection
