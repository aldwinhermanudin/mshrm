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
		$results_2 = \DB::select('SELECT id, nip, url, deskripsi, tempat_terjadi, waktu_terjadi, waktu_laporan, pelapor_akun FROM insiden_pegawai ORDER BY created_at DESC LIMIT 0,100');
		$results_3 = \DB::select('SELECT id, nip, nama_penugasan, keterangan, catatan_kinerja, tanggal_mulai, tanggal_selesai FROM kinerja_pegawai ORDER BY created_at DESC LIMIT 0,100');

		return view('admin.GetUserList')->with('results', $results)->with('results_2', $results_2)->with('results_3', $results_3);
	}

	public function GetUserDetail($nip)
	{
		if (\DB::select('SELECT 1 FROM data_pribadi WHERE nip = ?', [$nip]))
		{
			$results = \DB::select('SELECT * FROM data_pribadi where nip = ?', [$nip]);
			$results_2 = \DB::select('SELECT * FROM data_keluarga where nip = ?', [$nip]);
			$results_3 = \DB::select('SELECT * FROM riwayat_kerja where nip = ?', [$nip]);
			$provinces = \DB::select('SELECT * FROM data_provinsi');
			$positions = \DB::select('SELECT * FROM ms_jabatan');

			return view('admin.GetUserDetail')->with('results', $results)->with('results_2', $results_2)->with('results_3', $results_3)->with('nip', $nip)->with('provinces', $provinces)->with('positions', $positions);
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

				\DB::table('data_pribadi')
					->where('nip', $input['nip'])
					->update([
						'nama_lengkap' => $input['nama_lengkap'],
						'email' => $input['email'],
						'nama_lengkap' => $input['nama_lengkap'],
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
			\DB::delete('DELETE FROM data_pribadi where nip = ?', [$input['nip']]);
			\DB::delete('DELETE FROM data_keluarga where nip = ?', [$input['nip']]);
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
				'nip' => 'required|exists:data_pribadi,nip',
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
					deskripsi,
					tempat_terjadi,
					waktu_terjadi,
					waktu_laporan,
					photo_id,
					pelapor_nama,
					pelapor_akun,
					pelapor_nip,
					created_at
				) VALUES (?,?,?,?,?,?,?,?,?,?,?)', [
					$input['url'],
					$input['nip'],
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

	public function PostUserDetailFamily()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'nip' => 'required|exists:data_pribadi',
				'jumlah_anak' => 'integer|max:1024',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;

				\DB::table('data_keluarga')
					->where('nip', $input['nip'])
					->update([
						'nama_pasangan' => $input['nama_pasangan'],
						'jumlah_anak' => $input['jumlah_anak'],
						'nama_anak_1' => $input['nama_anak_1'],
						'nama_anak_2' => $input['nama_anak_2'],
						'nama_anak_3' => $input['nama_anak_3'],
						'nama_ibu' => $input['nama_ibu'],
						'nama_ayah' => $input['nama_ayah'],
						'kontak_keluarga_1' => $input['kontak_keluarga_1'],
						'kontak_keluarga_2' => $input['kontak_keluarga_2'],
						'updated_at' => $date
				]);

				return 'OK';
			}
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
				'nip' => 'required|exists:data_pribadi,nip',
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

	public function GetWorkHistory()
	{
		return view('admin.GetWorkHistory');
	}

	public function PostWorkHistory()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'nip' => 'required|exists:data_pribadi,nip|unique:riwayat_kerja',
				'instansi_terakhir' => 'max:256',
				'pangkat' => 'max:256',
				'jabatan' => 'max:256',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;

				\DB::insert('INSERT INTO riwayat_kerja(
					nip,
					instansi_terakhir,
					pangkat,
					jabatan,
					masa_kontrak_mulai,
					masa_kontrak_selesai,
					created_at,
					updated_at
				) VALUES (?,?,?,?,?,?,?,?)', [
					$input['nip'],
					$input['instansi_terakhir'],
					$input['pangkat'],
					$input['jabatan'],
					$input['masa_kontrak_mulai'],
					$input['masa_kontrak_selesai'],
					$date,
					$date
				]);
			}

			return 'OK';
		}
	}

	public function PostWorkHistoryEdit()
	{
		if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'instansi_terakhir' => 'max:256',
				'pangkat' => 'max:256',
				'jabatan' => 'max:256',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;

				\DB::table('riwayat_kerja')
					->where('nip', $input['nip'])
					->update([
						'instansi_terakhir' => $input['instansi_terakhir'],
						'pangkat' => $input['pangkat'],
						'jabatan' => $input['jabatan'],
						'masa_kontrak_mulai' => $input['masa_kontrak_mulai'],
						'masa_kontrak_selesai' => $input['masa_kontrak_selesai'],
						'updated_at' => $date
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
}
