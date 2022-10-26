<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\Penjual as ModelsPenjual;
use App\Models\Produsen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'status' => 'required|string',
            'number_phone' => 'required|string',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if($input['status'] == "Produsen") {
            Produsen::create([
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'status' => $request->status,
                'number_phone' => $request->number_phone,
            ]);
        }
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }
}
