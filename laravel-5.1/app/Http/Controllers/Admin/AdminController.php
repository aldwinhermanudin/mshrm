<?php

namespace mshrm\Http\Controllers\Admin;

use Illuminate\Http\Request;

use mshrm\Http\Requests;
use mshrm\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function GetUserlist()
    {
		$results = \DB::select('SELECT nip, nama_lengkap, jenis_kelamin, kota_nama, jenis_jabatan_nama, jenis_divisi_nama FROM data_pribadi');

		return view('admin.GetUserList')->with('results', $results);
	}

	public function GetUserDetail($nip)
	{
		if (\DB::select('SELECT 1 FROM data_pribadi WHERE nip = ?', [$nip]))
		{
			$results = \DB::select('SELECT * FROM data_pribadi where nip = ?', [$nip]);
			$results_2 = \DB::select('SELECT * FROM data_keluarga where nip = ?', [$nip]);

			return view('admin.GetUserDetail')->with('results', $results)->with('results_2', $results_2)->with('nip', $nip);
		}
	}

	public function GetUserErase($nip)
	{
		if (\DB::select('SELECT 1 FROM data_pribadi WHERE nip = ?', [$nip]))
		{
			\DB::delete('DELETE FROM data_pribadi where nip = ?', [$nip]);
			\DB::delete('DELETE FROM data_keluarga where nip = ?', [$nip]);

			$messages = 'User with ID '.$nip.' is deleted';
			return redirect('/admin/UserList')->with('messages', $messages);
		}
	}

	public function GetReportIncident()
	{
		return view('admin.GetReportIncident');
	}

	public function PostReportIncident()
	{
		if ((\Request::ajax()) && (\Request::hasFile('evidence')) && (\Request::file('evidence')->isValid()))
		{
			$file = \Request::file('evidence')->move('assets/uploads/images', 'awef');
			return 'OK';
		}
		else
		{
			return 'NOT OK';
		}
	}

	public function GetReportIncidentUser($nip)
	{

		$results = \DB::select('SELECT
			nip,
			nama_lengkap,
			no_hp,
			jenis_jabatan_nama,
			jenis_divisi_nama,
			created_at
		 FROM data_pribadi WHERE nip = ?', [$nip]);
		return view('ajax.ReportIncidentUser')->with('results', $results)->with('nip', $nip);
	}
}
