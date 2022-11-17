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
}
