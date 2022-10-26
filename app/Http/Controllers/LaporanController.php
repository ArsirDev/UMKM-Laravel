<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Laporan;

class LaporanController extends BaseController
{
    public function setLaporan(Request $request)
    {
        $success = Laporan::create([
            'produsen_name' => $request->produsen_name,
            'penjual_name' => $request->penjual_name,
            'product_name' => $request->product_name,
            'name_toko' => $request->name_toko,
            'qty' => $request->qty,
            'sisa_product' => $request->sisa_product,
            'laku_product' => $request->laku_product,
            'status' => $request->status,
        ]);

        return $this->sendResponse($success, "Successfully Create Laporan");
    }

    
    public function getLaporanProdusen(Request $request)
    {
        $select = $request->produsen_name;

        $success = Laporan::where('produsen_name', 'like', "%" . $select . "%")->get();


        return $this->sendResponse($success, "Successfully Show Laporan");
    }

    public function getLaporanPenjual(Request $request)
    {
        $select = $request->penjual_name;

        $success = Laporan::where('penjual_name', 'like', "%" . $select . "%")->get();


        return $this->sendResponse($success, "Successfully Show Laporan");
    }
}
