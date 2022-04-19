<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $emailCurrent = Auth::user()->email;
        $search = "";
        if ($request->get("search")) {
            $search = $request->get("search");
            $infoUser = DB::table("users")
                ->where("email", "!=", $emailCurrent)
                ->where("name", "like", "%$search%")
                ->orWhere("email", "like", "%$search%")
                ->get();

            return view("Chat.indexChat", [
                'index' => 1,
                'infoUser' => $infoUser,
                'search' => $search,
            ]);
        } else {
            $infoUser = DB::table("users")
                ->where("email", "!=", $emailCurrent)
                ->get();
            return view("Chat.indexChat", [
                'index' => 1,
                'infoUser' => $infoUser,
                'search' => $search,

            ]);
        }
    }

    public function show($id)
    {
        $user = DB::table("users")->where("id", $id)->get();

        // App::setLocale('vi');

        return view("Chat.indexCreate", [
            "user" => $user,
        ]);
    }
    public function getInfo(Request $request, $id)
    {
        $data = [];
        $user = DB::table("users")->where("id", $id)->get();
        $idUser1 = Auth::user()->id;
        $detailChat = DB::table("chat")
            ->join("detail_chat", "chat.id", "=", "detail_chat.idChat")
            ->where([["chat.idUser1", '=', $idUser1], ["chat.idUser2", '=', $id]])
            ->orWhere([["chat.idUser2", '=', $idUser1], ["chat.idUser1", '=', $id]])
            ->select("detail_chat.*")
            ->get();
        $data['data'] = $detailChat;
        $data['idUser1'] = $idUser1;
        echo json_encode($data);
    }



    public function store(Request $request)
    {
        $idUser1 = Auth::user()->id;
        $idUser2 = $request->get("id");
        $content = $request->get("msg-content");
        // dd($content);
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $time =  $dt->toDateTimeString();
        // dd($time);
        $checkChat = DB::table("chat")
            ->where([['idUser1', '=', $idUser1], ['idUser2', '=', $idUser2]])
            ->orWhere([['idUser2', '=', $idUser1], ['idUser1', '=', $idUser2]])
            ->count();
        // kiểm tra xem có đoạn chat nào hay chưa?
        // nếu chưa có thì tạo 1 đoạn chat
        // nếu có rồi thì lấy thông tin của đoạn chat đó ra và cập nhật thêm thông tin
        if ($checkChat == 0) {
            $createChat = DB::table("chat")
                ->insert([
                    "idUser1" => $idUser1,
                    "idUser2" => $idUser2
                ]);
            // dd($createChat);
            $getIdChat = DB::table("chat")->orderBy('id', 'desc')->first();
            // dd($getIdChat);
            foreach ($getIdChat as $value) {
                if ($content != null) {
                    $saveMes = DB::table("detail_chat")
                        ->insert([
                            "idChat" => $value->id,
                            "idUser" => $idUser1,
                            "content" => $content,
                            "created_at" => $time,
                        ]);
                }
            }
            $json['msg'] = "Thành công";
            $json['code'] = 200;
            echo json_encode($json);
        } else {
            $getIdChat = DB::table("chat")
                ->where([['idUser1', '=', $idUser1], ['idUser2', '=', $idUser2]])
                ->orWhere([['idUser2', '=', $idUser1], ['idUser1', '=', $idUser2]])
                ->get();
            foreach ($getIdChat as $value) {
                if ($content != null) {
                    $storeMes = DB::table("detail_chat")
                        ->insert([
                            "idChat" => $value->id,
                            "idUser" => $idUser1,
                            "content" => $content,
                            "created_at" => $time,
                        ]);
                }
            }
            $json['msg'] = "Thành công";
            $json['code'] = 200;
            echo json_encode($json);
        }
    }
}