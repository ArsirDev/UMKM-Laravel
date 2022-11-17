<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\LaporanPenjual;
use App\Models\LaporanProdusen;

class LaporanController extends BaseController
{
    public function setLaporan(Request $request)
    {
        $success = LaporanPenjual::create([
            'produsen_name' => $request->produsen_name,
            'penjual_name' => $request->penjual_name,
            'product_name' => $request->product_name,
            'name_toko' => $request->name_toko,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'sisa_product' => $request->sisa_product,
            'laku_product' => $request->laku_product,
            'barang_rusak' => $request->barang_rusak,
            'expired' => $request->expired,
            'tanggal_nitip' => $request->tanggal_nitip,
            'tanggal_pengambilan' => $request->tanggal_pengambilan, 
            'status' => $request->status,
        ]);

        $success = LaporanProdusen::create([
            'produsen_name' => $request->produsen_name,
            'penjual_name' => $request->penjual_name,
            'product_name' => $request->product_name,
            'name_toko' => $request->name_toko,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'sisa_product' => $request->sisa_product,
            'laku_product' => $request->laku_product,
            'keuntungan_produsen' => $request->keuntungan_produsen,
            'barang_rusak' => $request->barang_rusak,
            'expired' => $request->expired,
            'tanggal_nitip' => $request->tanggal_nitip,
            'tanggal_pengambilan' => $request->tanggal_pengambilan,
            'status' => $request->status,
        ]);

        return $this->sendResponse($success, "Successfully Create Laporan");
    }
}
