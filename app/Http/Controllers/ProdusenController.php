<?php

namespace App\Http\Controllers;

use App\Models\Produsen;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProdusenController extends BaseController
{
    public function getProdusen(Request $request)
    {
        $search = $request->search;

        $table = Produsen::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%" . $search . "%");
        })->paginate(10);

        return $this->sendResponse($table, "Successfully Search Produsen");
    }

    // public function getDetailProdusen(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Id tidak boleh kosong.', $validator->errors());
    //     }
    //     $id = $request->id;
    //     $success = Produsen::find($id);

    //     return $this->sendResponse($success, "Successfully Show Detail Penjual");
    // }
}
