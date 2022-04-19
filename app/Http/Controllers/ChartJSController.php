<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartJSController extends Controller
{
    public function index()
    {
        $countProd = DB::table("cate")
            ->join("product", "product.idCate", "=", "cate.idCate")
            ->selectRaw("nameCate, COUNT(product.idProd) as Count")
            ->groupBy("nameCate")
            ->get();

        return view('dashboard', [

            "cate" => $countProd,
        ]);
    }

    public function studyJS()
    {
        return view('exampleJS.index');
    }
}