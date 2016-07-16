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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/dist/css/skins/_all-skins.min.css') }}">


    <script src="{{ asset('/LTEAdmin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
  </head>
  <body class="hold-transition skin-blue layout-boxed sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="#" class="logo">
          <span class="logo-mini"><b>M</b>S</span>
          <span class="logo-lg"><b>Mitra</b>Siaga</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navigasi</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li><a id="set_language_english" href="#setLaguageEnglish">English</a></li>
              <li><a id="set_language_indonesia" href="#setLaguageIndonesia"><em>Indonesia</em></a></li>
              <input type="hidden" id="app_token" name="_token" value="{{ csrf_token() }}">

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('/LTEAdmin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="{{ asset('/LTEAdmin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->name }}
                      <small>Since {{ Auth::user()->created_at }}</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Log Out</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">NAVIGASI</li>

            @if ((Auth::user()->superadmin) or (Auth::user()->role_1) or (Auth::user()->role_2))
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Akun</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if ((Auth::user()->superadmin) or (Auth::user()->role_1))
                <li><a href="{{ url('/system/AccountRegister') }}"><i class="fa fa-user-plus"></i> Daftarkan Akun</a></li>
                @endif
                @if ((Auth::user()->superadmin) or (Auth::user()->role_2))
                <li><a href="{{ url('/system/AccountEdit') }}"><i class="fa fa-user-plus"></i> Ubah / Atur Akun</a></li>
                @endif
              </ul>
            </li>
            @endif

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Administrasi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/admin/EmployeeList') }}"><i class="fa fa-user-plus"></i> Daftar Pegawai</a></li>
                @if (Auth::user()->superadmin OR Auth::user()->role_5)
                <li><a href="{{ url('/admin/ReportIncident') }}"><i class="fa fa-user-plus"></i> Laporkan Insiden / Kecelakaan</a></li>
                @endif
                @if (Auth::user()->superadmin OR Auth::user()->role_6)
                <li><a href="{{ url('/admin/ReportPerformance') }}"><i class="fa fa-user-plus"></i> Catat Kinerja Pegawai</a></li>
                @endif
                @if (Auth::user()->superadmin OR Auth::user()->role_7)
                <li><a href="{{ url('/admin/RequestBreak') }}"><i class="fa fa-user-plus"></i> Mengajukan Cuti</a></li>
                @endif
                @if (Auth::user()->superadmin OR Auth::user()->role_11)
                <li><a href="{{ url('/admin/EmployeeAttendance') }}"><i class="fa fa-user-plus"></i> Daftar Hadir Pegawai</a></li>
                @endif
              </ul>
            </li>

            @if (Auth::user()->superadmin OR Auth::user()->role_3)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Pegawai</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/system/EmployeeRegister') }}"><i class="fa fa-user-plus"></i> Tambahkan Pegawai</a></li>
              </ul>
            </li>
            @endif

            @if (Auth::user()->superadmin OR Auth::user()->role_10)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Ekspor Data</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a id="button_export" href="#Exports" data-toggle="modal" data-target="#general_modal"><i class="fa fa-user-plus"></i> Lakukan Ekspor Data</a></li>
              </ul>
            </li>
            @endif

          </ul>
        </section>
      </aside>

@yield('content')

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1
        </div>
        Aplikasi Mitra Siaga Human Resource Management (MSHRM)<strong> ⋅ 2016 ⋅ PT. Mitra Siaga ⋅ </strong>Powered by PT. Pajon Teknologi
      </footer>
    </div>

    <script src="{{ asset('/LTEAdmin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/dist/js/demo.js') }}"></script>
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <div class="modal fade bs-example-modal-lg" id="general_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body" id="modal_content">
            Detil
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      function exportDetail()
      {
        $("#modal_content").empty().load("/admin/ExportDetail/");
      }
    </script>

    <script>
    $(document).ready(function()
  	{

      $("#button_export").click(function(){
        $("#modal_content").empty().load("/admin/ExportDetail/");
    	});

      $("#set_language_english").click(function(){
        $.post("/app/setting/lang",
  			{
  				_token: $("#app_token").val(),
  				lang: 'en',
  			},
  			function(data,status){
  				window.location.replace("/");
  			}).fail(function(data,status){
  				//failcodes
        });
    	});

      $("#set_language_indonesia").click(function(){
        $.post("/app/setting/lang",
  			{
  				_token: $("#app_token").val(),
  				lang: 'id',
  			},
  			function(data,status){
  				window.location.replace("/");
  			}).fail(function(data,status){
  			});
    	});

    });
    </script>
  </body>
</html>
@else
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/dist/css/skins/_all-skins.min.css') }}">
    <script src="{{ asset('/LTEAdmin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
  </head>
  <body class="hold-transition skin-blue layout-boxed sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="#" class="logo">
          <span class="logo-mini"><b>M</b>S</span>
          <span class="logo-lg"><b>Mitra</b>Siaga</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li><a id="set_language_english" href="#setLaguageEnglish"><em>English</em></a></li>
              <li><a id="set_language_indonesia" href="#setLaguageIndonesia">Indonesia</a></li>
              <input type="hidden" id="app_token" name="_token" value="{{ csrf_token() }}">

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('/LTEAdmin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="{{ asset('/LTEAdmin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->name }}
                      <small>Since {{ Auth::user()->created_at }}</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Log Out</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>

            @if ((Auth::user()->superadmin) or (Auth::user()->role_1) or (Auth::user()->role_2))
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Accounts</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if ((Auth::user()->superadmin) or (Auth::user()->role_1))
                <li><a href="{{ url('/system/AccountRegister') }}"><i class="fa fa-user-plus"></i> Register Account</a></li>
                @endif
                @if ((Auth::user()->superadmin) or (Auth::user()->role_2))
                <li><a href="{{ url('/system/AccountEdit') }}"><i class="fa fa-user-plus"></i> Edit / Set Account</a></li>
                @endif
              </ul>
            </li>
            @endif

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/admin/EmployeeList') }}"><i class="fa fa-user-plus"></i> Employee List</a></li>
                @if (Auth::user()->superadmin OR Auth::user()->role_5)
                <li><a href="{{ url('/admin/ReportIncident') }}"><i class="fa fa-user-plus"></i> Report Incident</a></li>
                @endif
                @if (Auth::user()->superadmin OR Auth::user()->role_6)
                <li><a href="{{ url('/admin/ReportPerformance') }}"><i class="fa fa-user-plus"></i> Record Performance</a></li>
                @endif
                @if (Auth::user()->superadmin OR Auth::user()->role_7)
                <li><a href="{{ url('/admin/RequestBreak') }}"><i class="fa fa-user-plus"></i> Request Break / Leave</a></li>
                @endif
                @if (Auth::user()->superadmin OR Auth::user()->role_11)
                <li><a href="{{ url('/admin/EmployeeAttendance') }}"><i class="fa fa-user-plus"></i> Employee's Attendance</a></li>
                @endif
              </ul>
            </li>

            @if (Auth::user()->superadmin OR Auth::user()->role_3)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Employee</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/system/EmployeeRegister') }}"><i class="fa fa-user-plus"></i> Add Employee</a></li>
              </ul>
            </li>
            @endif

            @if (Auth::user()->superadmin OR Auth::user()->role_10)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Exports</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a id="button_export" href="#Exports" data-toggle="modal" data-target="#general_modal"><i class="fa fa-user-plus"></i> Exports</a></li>
              </ul>
            </li>
            @endif

          </ul>
        </section>
      </aside>

@yield('content')

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1
        </div>
        Aplikasi Mitra Siaga Human Resource Management (MSHRM)<strong> ⋅ 2016 ⋅ PT. Mitra Siaga ⋅ </strong>Powered by PT. Pajon Teknologi
      </footer>
    </div>

    <script src="{{ asset('/LTEAdmin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/plugins/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('/LTEAdmin/dist/js/demo.js') }}"></script>
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

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

    <script>
      function exportDetail()
      {
        $("#modal_content").empty().load("/admin/ExportDetail/");
      }
    </script>

    <script>
    $(document).ready(function()
  	{

      $("#button_export").click(function(){
        $("#modal_content").empty().load("/admin/ExportDetail/");
    	});

      $("#set_language_english").click(function(){
        $.post("/app/setting/lang",
  			{
  				_token: $("#app_token").val(),
  				lang: 'en',
  			},
  			function(data,status){
  				window.location.replace("/");
  			}).fail(function(data,status){
  				//failcodes
        });
    	});

      $("#set_language_indonesia").click(function(){
        $.post("/app/setting/lang",
  			{
  				_token: $("#app_token").val(),
  				lang: 'id',
  			},
  			function(data,status){
  				window.location.replace("/");
  			}).fail(function(data,status){
  			});
    	});

    });
    </script>
  </body>
</html>
@endif
