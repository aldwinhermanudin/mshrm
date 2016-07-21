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
      $results = \DB::select('SELECT nip, uid, branch, nama_lengkap, jenis_kelamin, kota_nama, jenis_jabatan_nama, jenis_divisi_nama FROM data_pegawai');
			return view ('admin.GetAttendance')->with('results', $results);
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
            $query_string = $query_string.' , CASE WHEN select_1.date_in = \''.$year_current.'-'.$month_current.'-'.$day.'\' THEN select_1.shift ELSE 0 END AS \''.$day.'\' ';
            $day++;
          }

          $query_string = $query_string.' FROM data_pegawai d
            LEFT JOIN (SELECT * FROM time_sheet WHERE time_sheet.date_in >= \''.$year_current.'-'.$month_current.'-1\' AND time_sheet.date_in < \''.$year_next.'-'.$month_next.'-1\') select_1 on d.uid = select_1.uid) z GROUP BY z.uid';

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

  public function GetEmployeeAttendanceUpdate() {
    if ((\Auth::user()->superadmin) OR (\Auth::user()->role_11)) {
			if (\Request::ajax()) {
        \DB::update('UPDATE remote_database_1.work_log SET isread = ?', [1]);
        $results_1 = \DB::select('SELECT * FROM remote_database_1.work_log WHERE isread = ? AND isprocessed = ?', [1, 0]);
        \DB::update('UPDATE remote_database_1.work_log SET isprocessed = ? WHERE isread = ? AND isprocessed = ?', [1, 1, 0]);
        foreach ($results_1 as $result_1) {
          $count = 1;
          $date = date_create($result_1->timestamp);
          $date_formatted = date_format($date, 'Y-m-d');
          if (\DB::insert('INSERT IGNORE INTO time_sheet (uid, date_in, shift) VALUES (?, ?, ?)', [$result_1->uid, $date_formatted, 4])) {
            $count++;
          }
        }

        \DB::update('UPDATE remote_database_2.work_log SET isread = ?', [1]);
        $results_2 = \DB::select('SELECT * FROM remote_database_2.work_log WHERE isread = ? AND isprocessed = ?', [1, 0]);
        \DB::update('UPDATE remote_database_2.work_log SET isprocessed = ? WHERE isread = ? AND isprocessed = ?', [1, 1, 0]);
        foreach ($results_2 as $result_2) {
          $count = 1;
          $date = date_create($result_2->timestamp);
          $date_formatted = date_format($date, 'Y-m-d');
          if (\DB::insert('INSERT IGNORE INTO time_sheet (uid, date_in, shift) VALUES (?, ?, ?)', [$result_2->uid, $date_formatted, 4])) {
            $count++;
          }
        }

        \DB::update('UPDATE remote_database_3.work_log SET isread = ?', [1]);
        $results_3 = \DB::select('SELECT * FROM remote_database_3.work_log WHERE isread = ? AND isprocessed = ?', [1, 0]);
        \DB::update('UPDATE remote_database_3.work_log SET isprocessed = ? WHERE isread = ? AND isprocessed = ?', [1, 1, 0]);
        foreach ($results_3 as $result_3) {
          $count = 1;
          $date = date_create($result_3->timestamp);
          $date_formatted = date_format($date, 'Y-m-d');
          if (\DB::insert('INSERT IGNORE INTO time_sheet (uid, date_in, shift) VALUES (?, ?, ?)', [$result_3->uid, $date_formatted, 4])) {
            $count++;
          }
        }

        \DB::update('UPDATE remote_database_4.work_log SET isread = ?', [1]);
        $results_4 = \DB::select('SELECT * FROM remote_database_4.work_log WHERE isread = ? AND isprocessed = ?', [1, 0]);
        \DB::update('UPDATE remote_database_4.work_log SET isprocessed = ? WHERE isread = ? AND isprocessed = ?', [1, 1, 0]);
        foreach ($results_4 as $result_4) {
          $count = 1;
          $date = date_create($result_4->timestamp);
          $date_formatted = date_format($date, 'Y-m-d');
          if (\DB::insert('INSERT IGNORE INTO time_sheet (uid, date_in, shift) VALUES (?, ?, ?)', [$result_4->uid, $date_formatted, 4])) {
            $count++;
          }
        }
        return "<div class='callout callout-success'><h5>Data is updated from devices!</h5></div>";
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

  public function PostEmployeeAttendanceRecord() {
    if ((\Auth::user()->superadmin) OR (\Auth::user()->role_11)) {
			if (\Request::ajax()) {
        //actual code
        $input = \Request::all();

        $validator = \Validator::make($input, [
					'uid' => 'required|max:128',
          'tanggal' => 'required',
				]);

				if ($validator->fails())
				{
					return view('ajax.Feedback')->withErrors($validator);
				}
        else {
          $date = new \DateTime;
          \DB::insert('INSERT IGNORE INTO time_sheet (uid, date_in, from_device, shift, created_at) VALUES (?, ?, ?, ?, ?)', [
            $input['uid'],
            $input['tanggal'],
            0,
            $input['shift'],
            $date
          ]);
          return 'OK';
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
