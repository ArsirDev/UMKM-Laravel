<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\LaporanProdusen;

class LaporanProdusenController extends BaseController
{
    public function getLaporanProdusen(Request $request)
    {
        $select = $request->produsen_name;

        $success = LaporanProdusen::where('produsen_name', 'like', "%" . $select . "%")->get();

        return $this->sendResponse($success, "Successfully Show Laporan");
    }

    public function deleteLaporanProdusen(Request $request) {

        $success = LaporanProdusen::find($request->id)->delete();

        return $this->sendResponse($success, "Successfully Delete Laporan");
    }
}
