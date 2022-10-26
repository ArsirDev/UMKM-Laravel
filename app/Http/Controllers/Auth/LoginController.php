<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $kosong = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($kosong->fails()) {
            return $this->sendError(
                'email atau password tidak boleh kosong',
                ['error' => 'email atau password tidak boleh kosong']
            );
        }

        $exists = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($exists->fails()) {
            return $this->sendError(
                'Email tidak ditemukan, silahkan buat akun',
                ['error' => 'Email tidak ditemukan, silahkan buat akun']
            );
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->status == 'Penjual') {
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['nama_toko'] = $user->nama_toko;
                $success['email'] = $user->email;
                $success['alamat'] = $user->alamat;
                $success['status'] = $user->status;
                $success['number_phone'] = $user->number_phone;
                $success['password'] = $user->password;
                $success['image'] = $user->image;

                return $this->sendResponse($success, "login Successfully");
            }

            if ($user->status == 'Produsen' || 'Admin') {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['email'] = $user->email;
                $success['alamat'] = $user->alamat;
                $success['status'] = $user->status;
                $success['number_phone'] = $user->number_phone;
                $success['password'] = $user->password;

                return $this->sendResponse($success, "login Successfully");
            }
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function login_penjual(Request $request)
    {
        $kosong = Validator::make($request->all(), [
            'nama_toko' => 'required|string',
            'password' => 'required'
        ]);

        if ($kosong->fails()) {
            return $this->sendError(
                'Nama Toko atau password tidak boleh kosong',
                ['error' => 'Nama Toko atau password tidak boleh kosong']
            );
        }

        $exists = Validator::make($request->all(), [
            'nama_toko' => 'required|exists:users,nama_toko',
        ]);

        if ($exists->fails()) {
            return $this->sendError(
                'Nama Toko tidak ditemukan, silahkan buat akun',
                ['error' => 'Nama Toko tidak ditemukan, silahkan buat akun']
            );
        }
        if (Auth::attempt(['nama_toko' => $request->nama_toko, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->status == 'Penjual') {
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['nama_toko'] = $user->nama_toko;
                $success['email'] = $user->email;
                $success['alamat'] = $user->alamat;
                $success['status'] = $user->status;
                $success['number_phone'] = $user->number_phone;
                $success['password'] = $user->password;
                $success['image'] = $user->image;

                return $this->sendResponse($success, "login Successfully");
            }
        }
    }
}
