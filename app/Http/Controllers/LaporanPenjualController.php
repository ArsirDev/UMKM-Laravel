<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\LaporanPenjual;

class LaporanPenjualController extends BaseController
{
    public function getLaporanPenjual(Request $request)
    {
        $select = $request->penjual_name;

        $success = LaporanPenjual::where('penjual_name', 'like', "%" . $select . "%")->get();


        return $this->sendResponse($success, "Successfully Show Laporan");
    }

    public function deleteLaporanProdusen(Request $request) {

        $success = LaporanPenjual::find($request->id)->delete();

        return $this->sendResponse($success, "Successfully Delete Laporan");
    }
}
