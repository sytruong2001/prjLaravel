<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request, $lenght)
    {
        $UserId = Auth::user()->id;
        if ($UserId != null) {
            $ParentId = $request->get('parentId');
            $content = $request->get('content');
            $PostId = $request->get('PostId');
            Carbon::setLocale('vi');
            $time =  Carbon::now();
            $save = CommentModel::query()->insert([
                'UserId' => $UserId,
                'PostId' => $PostId,
                'ParentId' => $ParentId,
                'content' => $content,
                'created_at' => $time,
            ]);
            $idMax = CommentModel::query()->select('comment.id')
                ->where('PostId', $PostId)
                ->max('comment.id');
            $limit = CommentModel::query()->select('comment.*')
                ->where('PostId', $PostId)
                ->count();
            $json['msg'] = "Cập nhật dữ liệu thành công";
            $json['code'] = 200;
            $json['limit'] = $limit;
            $json['id'] = $idMax;
            $json['lenghtId'] = $lenght;
            echo json_encode($json);
        } else {
            $json['msg'] = "Chưa đăng nhập";
            $json['code'] = 401;
            echo json_encode($json);
        }
    }
}