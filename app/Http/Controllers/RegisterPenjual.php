<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Penjual as ModelsPenjual;
use Illuminate\Support\Facades\Validator;


class RegisterPenjual extends BaseController
{
    public function register_penjual(Request $request)
    {
        $validatorPenjual = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'nama_toko' => 'nullable',
            'alamat' => 'required',
            'status' => 'required',
            'number_phone' => 'required',
            'image' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validatorPenjual->fails()) {
            return $this->sendError('Validation Error.', $validatorPenjual->errors());
        }

        $path = $request->file('image')->store('images');
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['image'] = asset($path);
        $user = User::create($input);
        if ($input['status'] == 'Penjual') {
            ModelsPenjual::create([
                'name' => $request->name,
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'number_phone' => $request->number_phone,
                'image' => asset($path)
            ]);
        }
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }
}
