<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use App\Models\Penjual;
use App\Models\Produsen;
use App\Models\RequestProdusen;
use Illuminate\Support\Facades\Auth;

class PenjualController extends BaseController
{
    public function getPenjual(Request $request)
    {
        $search = $request->search;

        $table = Penjual::when($search, function ($q) use ($search) {
            $q->where('nama_toko', 'like', "%" . $search . "%");
        })->paginate(10);

        return $this->sendResponse($table, "Successfully Search Penjual");
    }

    public function getToko() 
    {
        $success = Penjual::select(['nama_toko'])->get()->toArray();
        return $this->sendResponse($success, "Successfully get Toko");
    }

    public function getDetailRequestPenjual(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:penjual,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Id tidak boleh kosong.', $validator->errors());
        }

        $user = Auth::user();
        $produsen = Produsen::select(['id'])->where('name', 'like', "%" . $user->name . "%")->get()->first();
        $penjualSuccess = Penjual::find($request->id);
        $responseSuccess['id_penjual'] = $penjualSuccess->id;
        $responseSuccess['id_produsen'] = $produsen->id;
        $responseSuccess['name_penjual'] = $penjualSuccess->name;
        $responseSuccess['name_produsen'] = $user->name;
        $responseSuccess['name_toko'] = $penjualSuccess->nama_toko;
        $responseSuccess['email_produsen'] = $user->email;
        $responseSuccess['alamat_produsen'] = $user->alamat;
        $responseSuccess['alamat_penjual'] = $penjualSuccess->alamat;
        $responseSuccess['number_phone_produsen'] = $user->number_phone;
        $responseSuccess['number_phone_penjual'] = $penjualSuccess->number_phone;
        $responseSuccess['image'] = $penjualSuccess->image;

        return $this->sendResponse($responseSuccess, "Successfully Show Detail");
    }
}
