<?php

namespace mshrm\Http\Controllers\Admin;

use Illuminate\Http\Request;

use mshrm\Http\Requests;
use mshrm\Http\Controllers\Controller;

class AttendanceController extends Controller
{
  public function __construct()
	{
		$this->middleware('auth');
	}

  public function GetEmployeeAttendance() {
		if ((\Auth::user()->superadmin) OR (\Auth::user()->role_11)) {
			//code
			return view ('admin.GetAttendance');
		}
		else {
			//if not authenticated and not authorized
			$message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
			return redirect ('/system/SystemNotification')->with('message', $message);
		}
	}

	public function PostEmployeeAttendance() {
		if ((\Auth::user()->superadmin) OR (\Auth::user()->role_11)) {
			if (\Request::ajax()) {
        //code
        return 'OK';
    	}
			else {
				//if request is not Ajax
				$message = "Ajax request only. / Hanya request Ajax yang diperbolehkan.";
				return redirect ('/system/SystemNotification')->with('message', $message);
			}
		}
		else {
			//if not authenticated and not authorized
			$message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
			return redirect ('/system/SystemNotification')->with('message', $message);
		}
	}

  public function PostEmployeeAttendanceTimeSheet() {
    if ((\Auth::user()->superadmin) OR (\Auth::user()->role_11)) {
			if (\Request::ajax()) {
        //code
        //params:
        //month, year. and done this shit.
        //- target_bulan
        //- target_tahun

        $input = \Request::all();
        $validator = \Validator::make($input, [
					'bulan' => 'required',
          'tahun' => 'required',
				]);

				if ($validator->fails()) {
					return view('ajax.Feedback')->withErrors($validator);
				}
        else {
          $days = cal_days_in_month(CAL_GREGORIAN, $input['bulan'], $input['tahun']);
          $day = 1;

          $month_current = $input['bulan'];
          $year_current = $input['tahun'];

          if ($month_current == 12) {
            $month_next = 1;
            $year_next = $year_current + 1;
          }
          else {
            $month_next = $month_current + 1;
            $year_next = $year_current;
          }

          $query_string = 'SELECT
            z.nip,
            z.uid,
            z.nama_lengkap,
            z.branch,
            z.jenis_jabatan,
            z.jenis_jabatan_nama,
            z.jenis_divisi,
            z.jenis_divisi_nama ';

          while ($day <= $days) {
            $query_string = $query_string.' , SUM(z.'.$day.') as \''.$day.'\' ';
            $day++;
          }

          $day = 1;

          $query_string = $query_string.'FROM (
            SELECT
            d.nip,
            d.uid,
            d.nama_lengkap,
            d.branch,
            d.jenis_jabatan,
            d.jenis_jabatan_nama,
            d.jenis_divisi,
            d.jenis_divisi_nama ';

          while ($day <= $days) {
            $query_string = $query_string.' , CASE WHEN select_1.date_in = \'2016-10-'.$day.'\' THEN select_1.shift ELSE 0 END AS \''.$day.'\' ';
            $day++;
          }

          $query_string = $query_string.' FROM data_pegawai d
            LEFT JOIN (SELECT * FROM time_sheet WHERE time_sheet.date_in >= \''.$year_current.'-'.$month_current.'-1\' AND time_sheet.date_in < \''.$year_next.'-'.$month_next.'-1\') select_1 on d.nip = select_1.nip) z GROUP BY z.nip';

          $results = \DB::select($query_string, []);

          return view('admin.GetAttendanceTable')->with('results', $results)->with('days', $days);
        }
      }
      else {
        //if request is not Ajax
				$message = "Ajax request only. / Hanya request Ajax yang diperbolehkan.";
				return redirect ('/system/SystemNotification')->with('message', $message);
      }
    }
    else {
      //if not authenticated and not authorized
			$message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
			return redirect ('/system/SystemNotification')->with('message', $message);
    }
  }
}
