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

  public function GetEmployeeList()
  {
		$results = \DB::select('SELECT nip, branch, nama_lengkap, jenis_kelamin, kota_nama, jenis_jabatan_nama, jenis_divisi_nama FROM data_pegawai');
		$results_2 = \DB::select('SELECT id, nip, tipe, url, deskripsi, tempat_terjadi, waktu_terjadi, waktu_laporan, pelapor_akun FROM insiden_pegawai ORDER BY created_at DESC LIMIT 0,100');
		$results_3 = \DB::select('SELECT id, nip, nama_penugasan, keterangan, catatan_kinerja, tanggal_mulai, tanggal_selesai FROM kinerja_pegawai ORDER BY created_at DESC LIMIT 0,100');
		$results_4 = 'Content';

		if (\Auth::user()->superadmin OR \Auth::user()->role_8) {
			$results_4 = \DB::select ('SELECT id, status_cuti, nip, nama_lengkap, pengganti_nip, pengganti_nama, tanggal_mulai, tanggal_selesai FROM data_cuti WHERE status_cuti = ? ORDER BY created_at ASC LIMIT 0,100', ['PENDING']);
		}
		else if (\Auth::user()->role_9) {
			$results_4 = \DB::select ('SELECT id, status_cuti, nip, nama_lengkap, pengganti_nip, pengganti_nama, tanggal_mulai, tanggal_selesai FROM data_cuti WHERE status_cuti = ? AND supervisor = ? ORDER BY created_at ASC LIMIT 0,100', ['PENDING', \Auth::user()->nip]);
		}

		return view('admin.GetEmployeeList')->with('results', $results)->with('results_2', $results_2)->with('results_3', $results_3)->with('results_4', $results_4);
	}

	public function GetUserDetail($nip)
	{
		if (\DB::select('SELECT 1 FROM data_pegawai WHERE nip = ?', [$nip]))
		{
			$results = \DB::select('SELECT * FROM data_pegawai where nip = ?', [$nip]);
			return view('admin.GetUserDetail')->with('results', $results)->with('nip', $nip);
		}
	}

	public function GetUserDetailEdit($nip)
	{
		if (\DB::select('SELECT 1 FROM data_pegawai WHERE nip = ?', [$nip]))
		{
			$results = \DB::select('SELECT * FROM data_pegawai where nip = ?', [$nip]);
			$provinces = \DB::select('SELECT * FROM data_provinsi');
			$positions = \DB::select('SELECT * FROM ms_jabatan');
			$branches = \DB::select('SELECT * FROM ms_branch');
			return view('admin.GetUserDetailEdit')->with('results', $results)->with('nip', $nip)->with('provinces', $provinces)->with('positions', $positions)->with('branches', $branches);
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
				'jenis_jabatan' => 'int|required|between:1,6',
				'jenis_divisi' => 'int|required|between:1,6',
				'picture' => 'mimes:jpeg|max:300',
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

				\DB::table('data_pegawai')
					->where('nip', $input['nip'])
					->update([
						'branch'  => $input['branch'],
						'nama_lengkap' => $input['nama_lengkap'],
						'tanggal_lahir' => $input['tanggal_lahir'],
						'jenis_kelamin' => $input['jenis_kelamin'],
						'no_telp' => $input['no_telp'],
						'no_hp' => $input['no_hp'],
						'email' => $input['email'],
						'status_pernikahan' => $input['status_pernikahan'],
						'kewarganegaraan' => $input['kewarganegaraan'],
						'no_ktp' => $input['no_ktp'],
						'alamat' => $input['alamat'],
						'provinsi' => $input['provinsi'],
						'provinsi_nama' => $provinsi_nama,
						'kota' => $input['kota'],
						'kota_nama' => $kota_nama,
						'kode_pos' => $input['kode_pos'],
						'suku' => $input['suku'],
						'literasi_membaca' => $input['literasi_membaca'],
						'literasi_menulis' => $input['literasi_menulis'],
						'pendidikan' => $input['pendidikan'],
						'riwayat_penyakit' => $input['riwayat_penyakit'],
						'bpjs_kesehatan' => $input['bpjs_kesehatan'],
						'bpjs_ketenagakerjaan' => $input['bpjs_ketenagakerjaan'],
						'asurasi' => $input['asurasi'],
						'jenis_jabatan' => $input['jenis_jabatan'],
						'jenis_jabatan_nama' => $jenis_jabatan_nama,
						'jenis_divisi' => $input['jenis_divisi'],
						'jenis_divisi_nama' => $jenis_divisi_nama,
						'nama_pasangan' => $input['nama_pasangan'],
						'jumlah_anak' => $input['jumlah_anak'],
						'nama_anak_1' => $input['nama_anak_1'],
						'nama_anak_2' => $input['nama_anak_2'],
						'nama_anak_3' => $input['nama_anak_3'],
						'nama_ibu' => $input['nama_ibu'],
						'nama_ayah' => $input['nama_ayah'],
						'kontak_keluarga_1' => $input['kontak_keluarga_1'],
						'kontak_keluarga_2' => $input['kontak_keluarga_2'],
						'instansi_terakhir' => $input['instansi_terakhir'],
						'pangkat' => $input['pangkat'],
						'jabatan' => $input['jabatan'],
						'masa_kontrak_mulai' => $input['masa_kontrak_mulai'],
						'masa_kontrak_selesai' => $input['masa_kontrak_selesai'],
						'tanggal_bergabung' => $input['tanggal_bergabung'],
						'status' => $input['status'],
						'catatan_kinerja' => $input['catatan_kinerja'],
						'updated_at' => $date
				]);

				return 'OK';
			}
		}
	}

	public function PostUserErase()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();
			\DB::delete('DELETE FROM data_pegawai where nip = ?', [$input['nip']]);
			return 'OK';
		}
	}

	public function GetReportIncident()
	{
		return view('admin.GetReportIncident');
	}

	public function PostReportIncident()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();
			$input['url'] = str_random(20);

			if ((\Request::hasFile('evidence')) && (\Request::file('evidence')->isValid()))
			{
				$input['evidence'] = \Request::file('evidence');
			}

			$validator = \Validator::make($input, [
				'url' => 'unique:insiden_pegawai',
				'nip' => 'required|exists:data_pegawai,nip',
				'deskripsi' => 'required|max:512',
				'tempat_terjadi' => 'required|max:256',
				'waktu_terjadi' => 'required',
				'waktu_laporan' => 'required',
				'evidence' => 'required|mimes:jpeg|max:600',
				'pelapor_nama' => 'required',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;

				if ((\Request::hasFile('evidence')) && (\Request::file('evidence')->isValid()))
				{
					$file = \Request::file('evidence')->move('assets/uploads/incidents', $input['url']);
				}

				\DB::insert('INSERT INTO insiden_pegawai (
					url,
					nip,
					tipe,
					deskripsi,
					tempat_terjadi,
					waktu_terjadi,
					waktu_laporan,
					photo_id,
					pelapor_nama,
					pelapor_akun,
					pelapor_nip,
					created_at
				) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)', [
					$input['url'],
					$input['nip'],
					$input['tipe'],
					$input['deskripsi'],
					$input['tempat_terjadi'],
					$input['waktu_terjadi'],
					$input['waktu_laporan'],
					$input['url'],
					$input['pelapor_nama'],
					\Auth::user()->name,
					\Auth::user()->nip,
					$date
				]);
			}

			return 'OK';
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
		 FROM data_pegawai WHERE nip = ?', [$nip]);
		return view('ajax.ReportIncidentUser')->with('results', $results)->with('nip', $nip);
	}

	public function GetReportPerformance()
	{
		return view('admin.GetReportPerformance');
	}

	public function PostReportPerformance()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'nip' => 'required|exists:data_pegawai,nip',
				'nama_penugasan' => 'required|max:256',
				'keterangan' => 'required',
				'catatan_kinerja' => 'required',
				'tanggal_mulai' => 'required',
				'tanggal_selesai' => 'required',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;

				\DB::insert('INSERT INTO kinerja_pegawai (
					nip,
					nama_penugasan,
					keterangan,
					catatan_kinerja,
					tanggal_mulai,
					tanggal_selesai,
					created_at,
					updated_at
				) VALUES (?,?,?,?,?,?,?,?)', [
					$input['nip'],
					$input['nama_penugasan'],
					$input['keterangan'],
					$input['catatan_kinerja'],
					$input['tanggal_mulai'],
					$input['tanggal_selesai'],
					$date,
					$date
				]);
			}

			return 'OK';
		}
	}

	public function GetIncidentDetail($id)
	{
		if (\Request::ajax())
		{
			$results = \DB::select('SELECT * FROM insiden_pegawai WHERE id = ?', [$id]);
			return view('admin.GetIncidentDetail')->with('results', $results);
		}
	}

	public function GetPerformanceDetail($id)
	{
		if (\Request::ajax())
		{
			$results = \DB::select('SELECT * FROM kinerja_pegawai WHERE id = ?', [$id]);
			return view('admin.GetPerformanceDetail')->with('results', $results);
		}
	}

	public function GetExportDetail()
	{
		if (\Request::ajax())
		{
			return view('admin.GetExportDetail');
		}
	}

	//REQUEST FOR BREAK
	public function GetRequestBreak()
	{
		if ((\Auth::user()->superadmin) OR (\Auth::user()->role_7)) {
			return view('admin.GetRequestBreak');
		}
		else {
			//if not authenticated and not authorized
			$message = "You are not authorized to use this function. / Anda tidak memiliki izin untuk mengakses fungsi ini.";
			return redirect ('/system/SystemNotification')->with('message', $message);
		}
	}

	public function PostRequestBreak()
	{
		if ((\Auth::user()->superadmin) OR (\Auth::user()->role_7)) {
			if (\Request::ajax())
			{
				$input = \Request::all();

				$validator = \Validator::make($input, [
					'nip' => 'required|exists:data_pegawai,nip',
					'pengganti_nip' => 'required|different:nip|exists:data_pegawai,nip',
					'tanggal_mulai' => 'required',
					'tanggal_selesai' => 'required|after:tanggal_mulai',
					'alasan_cuti' => 'required',
				]);

				if ($validator->fails())
				{
					return view('ajax.Feedback')->withErrors($validator);
				}
				else
				{
					$date = new \DateTime;
					$results = \DB::select('SELECT nama_lengkap, supervisor FROM data_pegawai WHERE nip = ?', [$input['nip']]);

					foreach ($results as $result)
					{
						$nama_lengkap = $result->nama_lengkap;
						$supervisor = $result->supervisor;
					}

					$results = \DB::select('SELECT nama_lengkap FROM data_pegawai WHERE nip = ?', [$input['pengganti_nip']]);

					foreach ($results as $result)
					{
						$pengganti_nama = $result->nama_lengkap;
					}

					$supervisor_nama_akun = \Auth::user()->name;
					$supervisor_nip = \Auth::user()->nip;

					\DB::insert('INSERT INTO data_cuti (
						status_cuti,
						nama_lengkap,
						nip,
						supervisor,
						pengganti_nama,
						pengganti_nip,
						supervisor_nama,
						supervisor_nama_akun,
						supervisor_nip,
						tanggal_mulai,
						tanggal_selesai,
						alasan_cuti,
						waktu_pengajuan,
						created_at,
						updated_at
					) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
						'PENDING',
						$nama_lengkap,
						$input['nip'],
						$supervisor,
						$pengganti_nama,
						$input['pengganti_nip'],
						$input['supervisor_nama'],
						$supervisor_nama_akun,
						$supervisor_nip,
						$input['tanggal_mulai'],
						$input['tanggal_selesai'],
						$input['alasan_cuti'],
						$date,
						$date,
						$date
					]);
				}
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

	public function GetRequestBreakDetail($id)
	{
		if (\Request::ajax())
		{
			$results = \DB::select('SELECT * FROM data_cuti WHERE id = ?', [$id]);

			foreach ($results as $result)
			{
				$nip = $result->nip;
			}

			$results_2 = \DB::select('SELECT * FROM data_cuti WHERE nip = ? ORDER BY created_at DESC LIMIT 0,100', [$nip]);

			return view('admin.GetRequestBreakDetail')->with('results', $results)->with('results_2', $results_2);
		}
		else {
			//if request is not Ajax
			$message = "Ajax request only. / Hanya request Ajax yang diperbolehkan.";
			return redirect ('/system/SystemNotification')->with('message', $message);
		}
	}

	public function PostProcessBreak()
	{
		if ((\Auth::user()->superadmin) OR (\Auth::user()->role_8) OR (\Auth::user()->role_9)) {
			if (\Request::ajax()) {
				$input = \Request::all();

				if (\DB::update('UPDATE data_cuti SET status_cuti = ? WHERE id =?', [$input['status'], $input['id']])) {
					return 'OK';
				}
				else {
					return "<div class='callout callout-warning'><h5>Not processed.</h5></div>";
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

	public function PostItemDelete()
	{
		if ((\Auth::user()->superadmin)) {
			if (\Request::ajax()) {
				$input = \Request::all();
				//id - Id in which table
				//tname = table name
				//return $input['tname'].$input['id'];

				if ($input['code'] == 2) {
					\DB::delete('DELETE FROM insiden_pegawai WHERE id = ?', [$input['id']]);
					return 'OK';
				}
				else if ($input['code'] == 3) {
					\DB::delete('DELETE FROM kinerja_pegawai WHERE id = ?', [$input['id']]);
					return 'OK';
				}
				else if ($input['code'] == 4) {
					\DB::delete('DELETE FROM data_cuti WHERE id = ?', [$input['id']]);
					return 'OK';
				}
				else {
					return "<div class='callout callout-warning'><h5>Not deleted.</h5></div>";
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
