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
			$provinces = \DB::select('SELECT * FROM data_provinsi');
			$positions = \DB::select('SELECT * FROM ms_jabatan');

			return view('admin.GetUserDetail')->with('results', $results)->with('results_2', $results_2)->with('nip', $nip)->with('provinces', $provinces)->with('positions', $positions);
		}
	}

	public function PostUserDetail()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();

			if ((\Request::hasFile('picture')) && (\Request::file('picture')->isValid()))
			{
				$input['file'] = \Request::file('picture');
			}

			$validator = \Validator::make($input, [
				'nama_lengkap' => 'required|max:512',
				'provinsi' => 'required',
				'kota' => 'required',
				'jenis_jabatan' => 'required',
				'jenis_divisi' => 'required',
				'picture' => 'mimes:jpeg|max:1000',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;

				$results = \DB::select('SELECT nama_jabatan, nama_divisi FROM ms_divisi WHERE kode_jabatan = ? AND kode_divisi = ?', [$input['jenis_jabatan'], $input['jenis_divisi']]);

				foreach ($results as $result)
				{
					$jenis_jabatan_nama = $result->nama_jabatan;
					$jenis_divisi_nama = $result->nama_divisi;
				}

				$results = \DB::select('SELECT name FROM data_provinsi WHERE id = ?', [$input['provinsi']]);

				foreach ($results as $result)
				{
					$provinsi_nama = $result->name;
				}

				$results = \DB::select('SELECT name FROM data_kota WHERE id_provinsi = ? AND id = ?', [$input['provinsi'], $input['kota']]);

				foreach ($results as $result)
				{
					$kota_nama = $result->name;
				}

				if ((\Request::hasFile('picture')) && (\Request::file('picture')->isValid()))
				{
					$file = \Request::file('picture')->move('assets/uploads/images', $input['nip']);
				}

				return 'OK';
			}
		}
	}

	public function PostUserErase()
	{
		\File::delete('/assets/uploads/images/872386124');
		return 'OK';
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
