<?php

namespace mshrm\Http\Controllers\System;

use Illuminate\Http\Request;

use mshrm\Http\Requests;
use mshrm\Http\Controllers\Controller;

class SystemController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function GetUserRegister()
    {
		$results = \DB::select('SELECT * FROM ms_jabatan');
		$results_2 = \DB::select('SELECT * FROM data_provinsi');

		return view('system.UserRegisterClone')->with('results', $results)->with('results_2', $results_2);
    }

  public function PostUserRegister()
  {
    if (\Request::ajax())
		{
			$input = \Request::all();

			if ((\Request::hasFile('picture')) && (\Request::file('picture')->isValid()))
			{
				$input['file'] = \Request::file('picture');
			}

			$validator = \Validator::make($input, [
				'nip' => 'required|max:128|unique:data_pribadi',
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

				\DB::insert('INSERT INTO data_pribadi(
						nip,
						nama_lengkap,
						jenis_kelamin,
						no_telp,
						no_hp,
						email,
						status_pernikahan,
						kewarganegaraan,
						no_ktp,
						alamat,
						provinsi,
						provinsi_nama,
						kota,
						kota_nama,
						kode_pos,
						suku,
						literasi_membaca,
						literasi_menulis,
						pendidikan,
						riwayat_penyakit,
						bpjs_kesehatan,
						bpjs_ketenagakerjaan,
						asurasi,
						jenis_jabatan,
						jenis_jabatan_nama,
						jenis_divisi,
						jenis_divisi_nama,
						created_at,
						updated_at
					) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
						$input['nip'],
						$input['nama_lengkap'],
						$input['jenis_kelamin'],
						$input['no_telp'],
						$input['no_hp'],
						$input['email'],
						$input['status_pernikahan'],
						$input['kewarganegaraan'],
						$input['no_ktp'],
						$input['alamat'],
						$input['provinsi'],
						$provinsi_nama,
						$input['kota'],
						$kota_nama,
						$input['kode_pos'],
						$input['suku'],
						$input['literasi_membaca'],
						$input['literasi_menulis'],
						$input['pendidikan'],
						$input['riwayat_penyakit'],
						$input['bpjs_kesehatan'],
						$input['bpjs_ketenagakerjaan'],
						$input['asurasi'],
						$input['jenis_jabatan'],
						$jenis_jabatan_nama,
						$input['jenis_divisi'],
						$jenis_divisi_nama,
						$date,
						$date
				]);

				return 'OK';
			}
		}
	}

    public function PostUserRegisterFile()
    {
		if ((\Request::ajax()) && (\Request::hasFile('file_csv')) && (\Request::file('file_csv')->isValid()))
		{
			$file = \Request::file('file_csv');
			$date = new \DateTime;


			$csvData = file_get_contents($file);
			$lines = explode(PHP_EOL, $csvData);
			$array = array();


			foreach ($lines as $line)
			{
				$array[] = str_getcsv($line);
			}

			$failed_entry = '';
			$failed_count = 1;
			$failed_sum = 0;

			foreach ($array as $item)
			{
				if (isset($item[0]))
				{
					$validator = \Validator::make(
						[
							'nip' => $item[0],
							'nama_lengkap' => $item[1]
						],
						[
							'nip' => 'required|unique:data_pribadi',
							'nama_lengkap' => 'required|min:8',
						]
					);

					if ($validator->fails())
					{
						$failed_entry = $failed_entry.','.$failed_count;
						$failed_sum = $failed_sum + 1;
					}
					else
					{

						\DB::insert('INSERT INTO data_pribadi(
								nip,
								nama_lengkap,
								jenis_kelamin,
								no_telp,
								no_hp,
								email,
								status_pernikahan,
								kewarganegaraan,
								no_ktp,
								alamat,
								provinsi,
								provinsi_nama,
								kota,
								kota_nama,
								kode_pos,
								suku,
								literasi_membaca,
								literasi_menulis,
								pendidikan,
								riwayat_penyakit,
								bpjs_kesehatan,
								bpjs_ketenagakerjaan,
								asurasi,
								jenis_jabatan,
								jenis_jabatan_nama,
								jenis_divisi,
								jenis_divisi_nama,
								created_at,
								updated_at
							) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
								$item[0],
								$item[1],
								$item[2],
								$item[3],
								$item[4],
								$item[5],
								$item[6],
								$item[7],
								$item[8],
								$item[9],
								$item[10],
								$item[11],
								$item[12],
								$item[13],
								$item[14],
								$item[15],
								$item[16],
								$item[17],
								$item[18],
								$item[19],
								$item[20],
								$item[21],
								$item[22],
								$item[23],
								$item[24],
								$item[25],
								$item[26],
								$date,
								$date
						]);

					}
				}

				$failed_count = $failed_count + 1;
			}


			if ($failed_sum > 0)
			{
				$failed_entry[0] = '(';
				$failed_entry = $failed_entry.')';
				$code = 1;

				\DB::insert('INSERT INTO csv_error(
						code,
						error_detail,
						error_count,
						error_seen,
					error_time) values (?,?,?,?,?)',[
						$code,
						$failed_entry,
						$failed_sum,
						0,
						$date
					]);
			}

			return '{"status":"success"}';
		}

		return '{"status":"error"}';
	}

	public function GetUserRegisterCheck($code)
	{

		$results = \DB::select('SELECT * FROM csv_error where error_seen = false AND code = ? ORDER BY error_time DESC LIMIT 0,1', [$code]);

		\DB::update('update csv_error set error_seen = true where code = ?', [$code]);

		return view('ajax.StatusCheck')->with('results', $results);
	}

	/* USER FAMILY DATA
	 *
	 *
	 *
	 *
	 */

    public function GetUserFamily()
    {
		return view('system.UserFamily');
    }

    public function GetUserFamilyCheck()
    {
        if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'nip' => 'required|exists:data_pribadi,nip',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				return 'OK';
			}
		}
    }

	public function PostUserFamily()
  {
    if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'nip' => 'required|exists:data_pribadi,nip|unique:data_keluarga',
				'jumlah_anak' => 'integer|max:1024',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$date = new \DateTime;
				\DB::insert('INSERT INTO data_keluarga (
						nip,
						nama_pasangan,
						jumlah_anak,
						nama_anak_1,
						nama_anak_2,
						nama_anak_3,
						nama_ibu,
						nama_ayah,
						kontak_keluarga_1,
						kontak_keluarga_2,
						created_at,
						updated_at
					) values (?,?,?,?,?,?,?,?,?,?,?,?)', [
						$input['nip'],
						$input['nama_pasangan'],
						$input['jumlah_anak'],
						$input['nama_anak_1'],
						$input['nama_anak_2'],
						$input['nama_anak_3'],
						$input['nama_ibu'],
						$input['nama_ayah'],
						$input['kontak_keluarga_1'],
						$input['kontak_keluarga_2'],
						$date,
						$date
				]);

				return 'OK';
			}
		}
	}

    public function PostUserFamilyFile()
    {
		if ((\Request::ajax()) && (\Request::hasFile('file_csv')) && (\Request::file('file_csv')->isValid()))
		{
			$file = \Request::file('file_csv');
			$date = new \DateTime;


			$csvData = file_get_contents($file);
			$lines = explode(PHP_EOL, $csvData);
			$array = array();

			foreach ($lines as $line)
			{
				$array[] = str_getcsv($line);
			}

			//var_dump($array);
			$failed_entry = '';
			$failed_count = 1;
			$failed_sum = 0;

			foreach ($array as $item)
			{
				if (isset($item[0]))
				{
					$validator = \Validator::make(
						[
							'nip' => $item[0],
							'jumlah_anak' => $item[2]
						],
						[
							'nip' => 'exists:data_pribadi,nip|unique:data_keluarga',
							'jumlah_anak' => 'integer|max:1024',
						]
					);

					if ($validator->fails())
					{
						$failed_entry = $failed_entry.','.$failed_count;
						$failed_sum = $failed_sum + 1;
					}
					else
					{
						\DB::insert('INSERT INTO data_keluarga(
								nip,
								nama_pasangan,
								jumlah_anak,
								nama_anak_1,
								nama_anak_2,
								nama_anak_3,
								nama_ibu,
								nama_ayah,
								kontak_keluarga_1,
								kontak_keluarga_2,
								created_at,
								updated_at
							) values (?,?,?,?,?,?,?,?,?,?,?,?)', [
								$item[0],
								$item[1],
								$item[2],
								$item[3],
								$item[4],
								$item[5],
								$item[6],
								$item[7],
								$item[8],
								$item[9],
								$date,
								$date
						]);
					}
				}

				$failed_count = $failed_count + 1;
			}

			if ($failed_sum > 0)
			{
				$failed_entry[0] = '{';
				$failed_entry = $failed_entry.'}';
				$code = 2;

				\DB::insert('INSERT INTO csv_error(
						code,
						error_detail,
						error_count,
						error_seen,
					error_time) values (?,?,?,?,?)',[
						$code,
						$failed_entry,
						$failed_sum,
						0,
						$date
					]);
			}

			return '{"status":"success"}';
		}

		return '{"status":"error"}';
	}

	//AJAX

	public function GetContentDivision($kode_jabatan)
	{
        if (\Request::ajax() && $kode_jabatan != '')
        {
			$results = \DB::select('SELECT * FROM ms_divisi where kode_jabatan = ?', [$kode_jabatan]);

			return view('ajax.GetContentDivision')->with('results', $results);
		}
	}

	public function GetContentCity($kode_provinsi)
	{
        if (\Request::ajax() && $kode_provinsi != '')
        {

			$results = \DB::select('SELECT * FROM data_kota where id_provinsi = ?', [$kode_provinsi]);
			return view('ajax.GetContentCity')->with('results', $results);
		}
	}
}
