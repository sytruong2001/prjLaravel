<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\Foreach_;

class ProdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get("search")) {
            $search = $request->get("search");
            $products = DB::table("product")
                ->join("cate", "product.idCate", "=", "cate.idCate")
                ->select("product.*", "cate.nameCate", "cate.available as cateAvailable")
                ->where("nameProd", "like", "%$search%")
                ->orWhere("nameCate", "like", "%$search%")
                ->get();
            return view("Prod.indexProd", [
                "index" => 1,
                "products" => $products,
            ]);
        } else {
            $products = DB::table("product")
                ->join("cate", "product.idCate", "=", "cate.idCate")
                ->select("product.*", "cate.nameCate", "cate.available as cateAvailable")
                ->get();
            return view("Prod.indexProd", [
                "index" => 1,
                "products" => $products,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = DB::table("cate")->get();
        return view("Prod.indexCreate", [
            'cate' => $cate,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nameProd = $request->get("nameProd");
        $description = $request->get("description");
        $idCate = $request->get("idCate");

        $checkProd = DB::table("product")->where("nameProd", "=", $nameProd)->count();

        if ($checkProd > 0) {
            return redirect()->back()->with("errors", "Tên sản phẩm đã tồn tại");
        } else {
            $product = DB::table('product')->insert([
                'nameProd' => $nameProd,
                'description' => $description,
                'idCate' => $idCate,
            ]);
            return redirect()->back()->with("message", "Thêm thành công");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::table("product")->where("idProd", $id)->get();

        $cate = DB::table("cate")->get();

        return view("Prod.updateProd", [
            'index' => 1,
            'product' => $product,
            'cate' => $cate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nameProd = $request->get('nameProd');
        $idCate = $request->get('idCate');
        $description = $request->get('description');

        $data = DB::table('product')
            ->where('idProd', $id)
            ->update([
                'nameProd' => $nameProd,
                'description' => $description,
                'idCate' => $idCate,
            ]);
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
    }

    public function hide($id)
    {
        $available = DB::table("product")
            ->where("idProd", $id)
            ->get();
        foreach ($available as $value) {
            if ($value->available == null) {
                $checkCate = DB::table("cate")
                    ->where("idCate", $value->idCate)
                    ->get();
                foreach ($checkCate as $item) {
                    if ($item->available == 0) {
                        return redirect()->back()->with("errors", "Không thể hiển thị sản phẩm '$value->nameProd' vì thể loại '$item->nameCate' hiện không tồn tại");
                    } else {
                        $hide = DB::table("product")
                            ->where("idProd", $id)
                            ->update([
                                'available' => 1
                            ]);
                        return redirect()->back();
                    }
                }
            } else {
                $appear = DB::table("product")
                    ->where("idProd", $id)
                    ->update([
                        'available' => null
                    ]);
                return redirect()->back();
            }
        }
    }
}