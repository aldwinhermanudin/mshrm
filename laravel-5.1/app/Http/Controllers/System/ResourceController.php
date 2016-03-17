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
    if (\Storage::disk('local')->has('code_'.$code.'.csv'))
    {
      $contents = 'resources/code_'.$code.'.csv';
      return response()->download($contents);
    }
		else
		{
			return 'No file is found';
		}
  }

  public function GetEmployeeListXLSX()
  {
    \DB::setFetchMode(\PDO::FETCH_ASSOC);
    $results = \DB::table('data_pribadi')->get();

    \DB::setFetchMode(\PDO::FETCH_CLASS);

    \Excel::create('EmployeeList_PTMitraSiaga', function($excel) use($results) {
      $excel->setTitle('EmployeeList');
      $excel->setCreator('PT. Mitra Siaga')->setCompany('PT. Mitra Siaga');
      $excel->setDescription('XLSX - List of Employees');

      $excel->sheet('EmployeeList', function($sheet) use($results) {
        $sheet->freezeFirstRow();
        $sheet->setStyle(array(
          'font' => array(
            'name'      =>  'Calibri',
            'size'      =>  13
          )
        ));
        $sheet->setBorder('A1:AE1', 'thick');
        $sheet->fromArray($results);
      });

    })->export('xlsx');
  }

  public function GetEmployeeListPDF()
  {
    $results = \DB::select('SELECT * FROM data_pribadi');
    $date = date('Y-m-d H:m:s');
    $html = view('pdf.EmployeeList')->with('results', $results)->with('date', $date);

    $pdf = \PDF::loadHtml($html)->setPaper('a4', 'landscape');
    return $pdf->download('EmployeeList_PTMitraSiaga.pdf');
  }
}
