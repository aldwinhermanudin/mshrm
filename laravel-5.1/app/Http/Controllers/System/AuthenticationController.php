<?php

namespace mshrm\Http\Controllers\System;

use Illuminate\Http\Request;

use mshrm\Http\Requests;
use mshrm\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
	public function PostAccountRegister()
	{
        if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'nip' => 'required|max:128|unique:users',
				'email' => 'required|email|max:256|unique:users',
				'name' => 'required|max:512',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				//$password_plain = str_random(10);
				$password_plain = 'mypass123';
				$password_hashed = bcrypt($password_plain);
				$email = $input['email'];
				$nama_lengkap = $input['name'];

				$data['password'] = $password_plain;
				$data['email'] = $input['email'];
				$data['name'] = $input['name'];

				$date = new \DateTime;

				\Mail::send('emails.AccountRegister', $data, function($message) use ($email, $nama_lengkap)
				{
					$message->to($email, $nama_lengkap)->subject('Welcome!');
				});

				\DB::insert('INSERT INTO users (
						nip,
						name,
						email,
						password,
						superadmin,
						role_1,
						role_2,
						role_3,
						role_4,
						role_5,
						role_6,
						created_at,
						updated_at
					) values (?,?,?,?,?,?,?,?,?,?,?,?,?)', [
						$input['nip'],
						$input['name'],
						$input['email'],
						$password_hashed,
						false,
						false,
						false,
						false,
						false,
						false,
						false,
						$date,
						$date
				]);

				return 'OK';
			}
		}
	}

	public function GetPassword()
	{
		return view('auth.password');
	}

	public function PostPassword()
	{
        if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'email' => 'required|exists:users,email',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$results = \DB::select('SELECT name from users where email = ?', [$input['email']]);

				foreach ($results as $result)
				{
					$name = $result->name;
				}

				$token_plain = str_random(20);
				$email = $input['email'];

				$data['name'] = $name;
				$data['token'] = $token_plain;

				$date = new \DateTime;

				\Mail::send('emails.PasswordReset', $data, function($message) use ($email, $name)
				{
					$message->to($email, $name)->subject('Reset Password');
				});

				\DB::delete('DELETE FROM password_reset where email = ?', [$input['email']]);

				\DB::insert('INSERT INTO password_reset (
						email,
						token,
						confirmed,
						created_at
					) values (?,?,?,?)', [
						$input['email'],
						$token_plain,
						false,
						$date
				]);

				return 'OK';
			}
		}
	}

	public function GetConfirm($token)
	{
		return view('auth.confirm')->with('reset_token', $token);
	}

	public function PostConfirm()
	{
        if (\Request::ajax())
		{
			$input = \Request::all();

			$validator = \Validator::make($input, [
				'reset_token' => 'required|exists:password_reset,token',
				'password' => 'required|max:128|confirmed',
			]);

			if ($validator->fails())
			{
				return view('ajax.Feedback')->withErrors($validator);
			}
			else
			{
				$results = \DB::select('SELECT email from password_reset where token = ?', [$input['reset_token']]);

				foreach ($results as $result)
				{
					$email = $result->email;
				}

				$date = new \DateTime;

				\DB::table('users')
					->where('email', $email)
					->update(['password' => bcrypt($input['password']), 'updated_at' => $date]);

				\DB::delete('DELETE FROM password_reset where email = ?', [$email]);

return 'OK';
			}
		}
	}
}
