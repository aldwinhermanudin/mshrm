<?php

namespace mshrm\Http\Controllers\System;

use Illuminate\Http\Request;

use mshrm\Http\Requests;
use mshrm\Http\Controllers\Controller;

class ResourceController extends Controller
{
  public function __construct()
	{
		$this->middleware('auth');
	}

  public function GetCSV($code)
  {
    if (\Storage::disk('local')->has('code_'.$code.'.csv')) {
      $contents = 'resources/code_'.$code.'.csv';
      return response()->download($contents);
    }
		else {
			return 'No file is found';
		}
  }

  public function Guard() {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      //code here
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetAccountListXLSX() {
    if ((\Auth::user()->superadmin OR \Auth::user()->role_10)) {
      \DB::setFetchMode(\PDO::FETCH_ASSOC);
      $results = \DB::table('users')->get();

      //\DB::setFetchMode(\PDO::FETCH_CLASS);

      \Excel::create('AccountList_PTMitraSiaga', function($excel) use($results) {
        $excel->setTitle('List of Accounts / Daftar Akun');
        $excel->setCreator('PT. Mitra Siaga')->setCompany('PT. Mitra Siaga');
        $excel->setDescription('XLSX - List of Accounts / Daftar Akun');

        $excel->sheet('EmployeeList', function($sheet) use($results) {
          $sheet->freezeFirstRow();
          $sheet->setStyle(array(
            'font' => array(
              'name'      =>  'Calibri',
              'size'      =>  13
            )
          ));
          //$sheet->setBorder('A1:AE1', 'thick');
          $sheet->fromArray($results);
        });

      })->export('xlsx');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetEmployeeListXLSX() {
    if ((\Auth::user()->superadmin OR \Auth::user()->role_10)) {
      \DB::setFetchMode(\PDO::FETCH_ASSOC);
      $results = \DB::table('data_pegawai')->get();

      //\DB::setFetchMode(\PDO::FETCH_CLASS);

      \Excel::create('EmployeeList_PTMitraSiaga', function($excel) use($results) {
        $excel->setTitle('List of Employee / Daftar Pegawai');
        $excel->setCreator('PT. Mitra Siaga')->setCompany('PT. Mitra Siaga');
        $excel->setDescription('XLSX - List of Employee / Daftar Pegawai');

        $excel->sheet('EmployeeList', function($sheet) use($results) {
          $sheet->freezeFirstRow();
          $sheet->setStyle(array(
            'font' => array(
              'name'      =>  'Calibri',
              'size'      =>  13
            )
          ));
          //$sheet->setBorder('A1:AE1', 'thick');
          $sheet->fromArray($results);
        });

      })->export('xlsx');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetIncidentListXLSX() {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      \DB::setFetchMode(\PDO::FETCH_ASSOC);
      $results = \DB::table('insiden_pegawai')->get();

      //\DB::setFetchMode(\PDO::FETCH_CLASS);

      \Excel::create('IncidentAccidentList_PTMitraSiaga', function($excel) use($results) {
        $excel->setTitle('List of Incident and Accident / Daftar Insiden dan Kecelakaan');
        $excel->setCreator('PT. Mitra Siaga')->setCompany('PT. Mitra Siaga');
        $excel->setDescription('XLSX - List of Incident and Accident / Daftar Insiden dan Kecelakaan');

        $excel->sheet('EmployeeList', function($sheet) use($results) {
          $sheet->freezeFirstRow();
          $sheet->setStyle(array(
            'font' => array(
              'name'      =>  'Calibri',
              'size'      =>  13
            )
          ));
          //$sheet->setBorder('A1:AE1', 'thick');
          $sheet->fromArray($results);
        });

      })->export('xlsx');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetBreakListXLSX() {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      \DB::setFetchMode(\PDO::FETCH_ASSOC);
      $results = \DB::table('data_cuti')->get();

      //\DB::setFetchMode(\PDO::FETCH_CLASS);

      \Excel::create('BreakList_PTMitraSiaga', function($excel) use($results) {
        $excel->setTitle('List of Break / Daftar Cuti');
        $excel->setCreator('PT. Mitra Siaga')->setCompany('PT. Mitra Siaga');
        $excel->setDescription('XLSX - List of Break / Daftar Cuti');

        $excel->sheet('EmployeeList', function($sheet) use($results) {
          $sheet->freezeFirstRow();
          $sheet->setStyle(array(
            'font' => array(
              'name'      =>  'Calibri',
              'size'      =>  13
            )
          ));
          //$sheet->setBorder('A1:AE1', 'thick');
          $sheet->fromArray($results);
        });

      })->export('xlsx');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  //PDF SECTIONS
  //Account
  //Employee
  //Incident
  //Break
  //Absen

  public function GetAccountListPDF()
  {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      $results = \DB::select('SELECT * FROM users');
      $date = date('Y-m-d H:m:s');
      $html = view('pdf.AccountList')->with('results', $results)->with('date', $date);

      $pdf = \PDF::loadHtml($html)->setPaper('a4', 'landscape');
      return $pdf->download('AccountList_PTMitraSiaga.pdf');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetEmployeeListPDF()
  {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      $results = \DB::select('SELECT * FROM data_pegawai WHERE nip = 14102007');
      $date = date('Y-m-d H:m:s');
      $html = view('pdf.EmployeeList')->with('results', $results)->with('date', $date);

      $pdf = \PDF::loadHtml($html)->setPaper('a4', 'landscape');
      return $pdf->download('EmployeeList_PTMitraSiaga.pdf');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetIncidentListPDF()
  {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      $results = \DB::select('SELECT * FROM insiden_pegawai ORDER BY created_at DESC');
      $date = date('Y-m-d H:m:s');
      $html = view('pdf.IncidentList')->with('results', $results)->with('date', $date);

      $pdf = \PDF::loadHtml($html)->setPaper('a4', 'landscape');
      return $pdf->download('IncidentList_PTMitraSiaga.pdf');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }

  public function GetBreakListPDF()
  {
    if (\Auth::user()->superadmin OR \Auth::user()->role_10) {
      $results = \DB::select('SELECT * FROM data_cuti ORDER BY created_at DESC');
      $date = date('Y-m-d H:m:s');
      $html = view('pdf.BreakList')->with('results', $results)->with('date', $date);

      $pdf = \PDF::loadHtml($html)->setPaper('a4', 'landscape');
      return $pdf->download('BreakList_PTMitraSiaga.pdf');
    }
    else {
      //if not authenticated and not authorized
      $message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
      return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }
}
