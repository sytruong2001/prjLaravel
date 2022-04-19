<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = "";
        if ($request->get("search")) {
            $search = $request->get("search");
            $cate = DB::table("cate")
                ->where("nameCate", "like", "%$search%")
                ->get();
            return view("Cate.indexCate", [
                'index' => 1,
                'cate' => $cate,
                'search' => $search,
            ]);
        } else {
            $cate = DB::table("cate")->get();
            return view("Cate.indexCate", [
                'index' => 1,
                'cate' => $cate,
                'search' => $search,

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
        return view("Cate.indexCreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nameCate = $request->get("nameCate");
        $checkCate = DB::table("cate")->where("nameCate", $nameCate)->count();
        // kiểm tra xem tên thể loại mới trùng với trong bảng cate hay ko
        // nếu có thì quay về trang thêm và hiện thông báo lỗi
        // nếu chưa tồn tại thì thêm vào db và hiện thông báo thành công

        if ($checkCate > 0) {
            return redirect()->back()->with("errors", "Têm thể loại bạn thêm đã tồn tại!");
        } else {
            $cate = DB::table("cate")->insert([
                'nameCate' => $nameCate,
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

        $cate = DB::table("cate")->where("idCate", $id)->get();

        return view("Cate.updateCate", [
            'index' => 1,
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
        $nameCate = $request->get('nameCate');

        $data = DB::table('cate')
            ->where('idCate', $id)
            ->update([
                'nameCate' => $nameCate,
            ]);
        return redirect('cate');
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
        $available = DB::table("cate")
            ->where("idCate", $id)
            ->select("available")
            ->get();
        foreach ($available as $value) {
            if ($value->available == 1) {

                $hideCate = DB::table("cate")
                    ->where("idCate", $id)
                    ->update([
                        'available' => 0
                    ]);
            } else {

                $hideCate = DB::table("cate")
                    ->where("idCate", $id)
                    ->update([
                        'available' => 1
                    ]);
            }
        }
        return redirect()->back();
    }
}