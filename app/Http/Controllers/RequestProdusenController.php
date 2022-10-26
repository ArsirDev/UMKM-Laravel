<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Penjual;
use App\Models\Produsen;
use App\Models\RequestProdusen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestProdusenController extends BaseController
{

    
    public function getDetailProdusenRequest(Request $request)
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

    public function setDetailProdusenRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penjual' => 'required',
            'id_produsen' => 'required',
            'name_penjual' => 'required',
            'name_produsen' => 'required',
            'name_toko' => 'required',
            'product_name' => 'required',
            'email_produsen' => 'required',
            'alamat_produsen' => 'required',
            'alamat_penjual' => 'required',
            'number_phone_produsen' => 'required',
            'number_phone_penjual' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'image_produsen' => 'required',
            'image_penjual' => 'required',
            'status_penitipan' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Id tidak boleh kosong.', $validator->errors());
        }

        $pathProdusen = $request->file('image_produsen')->store('images');
        $success = RequestProdusen::create([
            'id_penjual' => $request->id_penjual,
            'id_produsen' => $request->id_produsen,
            'name_penjual' => $request->name_penjual,
            'name_produsen' => $request->name_produsen,
            'name_toko' => $request->name_toko,
            'product_name' => $request->product_name,
            'email_produsen' => $request->email_produsen,
            'alamat_produsen' => $request->alamat_produsen,
            'alamat_penjual' => $request->alamat_penjual,
            'number_phone_produsen' => $request->number_phone_produsen,
            'number_phone_penjual' => $request->number_phone_penjual,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'image_produsen' => asset($pathProdusen),
            'image_penjual' => $request->image_penjual,
            'status_penitipan' => $request->status_penitipan,
        ]);

        return $this->sendResponse($success, "Successfully make request");
    }

    public function getSpesifictDetailProdusenRequest(Request $request)
    {
        $id = $request->id;

        $success = RequestProdusen::find($id);

        return $this->sendResponse($success, "Successfully Show Detail Request Produsen");
    }

    public function getAllDetailProdusenRequest(Request $request) 
    {
        $select = $request->name_toko;

        $success = RequestProdusen::where('name_toko', 'like', "%" . $select . "%")->get();

        return $this->sendResponse($success, "Successfully Show Detail Request Produsen");
    }

    public function updateProdusenRequest(Request $request) {
        $success = RequestProdusen::find($request->id)->update([
            'status_penitipan' => $request->status_penitipan,
        ]);

        return $this->sendResponse($success, "Successfully update detail request");
    }

    public function deleteProdusenRequest(Request $request) 
    {
        $success = RequestProdusen::find($request->id)->delete();

        return $this->sendResponse($success, "Successfully delete request");

    }
}