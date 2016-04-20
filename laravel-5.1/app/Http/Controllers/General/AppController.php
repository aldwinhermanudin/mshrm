<?php

namespace mshrm\Http\Controllers\General;

use Illuminate\Http\Request;

use mshrm\Http\Requests;
use mshrm\Http\Controllers\Controller;

class AppController extends Controller
{
  public function PostSettingLang()
  {
    $input = \Request::all();

    \Cookie::queue('ms_lang', $input['lang'], 3600);
    return 'OK';
  }
}
