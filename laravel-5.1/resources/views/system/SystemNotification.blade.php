@if (Cookie::get('ms_lang') == null)
  <?php
    $language = 'en';
  ?>
@else
  <?php
    $language = Cookie::get('ms_lang');
  ?>
@endif

@extends('core.app')
@section('content')
@if ($language == 'id')

  <link href="{{ asset('/A/css/style.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.css') }}">
  <title>2016 mshrm ⋅ Notifikasi Sistem</title>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Notifikasi Sistem
        <small>Notifikasi dari sistem</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Notifikasi Sistem</li>
      </ol>
    </section>

    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-body">
          <div style="text-align: center;">
            @if(Session::has('message'))
              <h4>{{ Session::get('message') }}</h4>
            @else
              <h4>Tidak ada notifikasi saat ini.</h4>
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
@else
  <link href="{{ asset('/A/css/style.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.css') }}">
  <title>2016 mshrm ⋅ System Notification</title>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        System Notification
        <small>Notification from System</small>
      </h1>

      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> System Notification</li>
      </ol>
    </section>

    <section class="content">
      <div id="page_feedback"></div>
      <div class="box">
        <div class="box-body">
          <div style="text-align: center;">
            @if(Session::has('message'))
              <h4>{{ Session::get('message') }}</h4>
            @else
              <h4>There is no notification.</h4>
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
@endif
@endsection
