<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\CommentModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DetailPostController extends Controller
{
    public function index(Request $request)
    {
        $slug = $request->path();
        return view('User.detailPost');
    }

    public function getDetailPost(Request $request)
    {
        $slug = substr($request->get('slug'), 6);
        $id = $request->get('id');
        $limit = $request->get('limit');
        if ($slug != null) {
            $info = PostModel::query()
                ->with(
                    'comment',
                    'rep',
                    'user'
                )
                ->where('post.slug', $slug)
                ->first();
            $cmt = [];
            $rep = [];
            Carbon::setLocale('vi');
            $now = Carbon::now();
            if ($id != null) {
                foreach ($info->comment as $check) {
                    if ($id < $check->id) {
                        $comment = CommentModel::query()
                            ->join('post', 'comment.PostId', '=', 'post.id')
                            ->where('post.slug', $slug)
                            ->where('comment.ParentId', null)
                            ->select('comment.*')
                            ->limit($limit)
                            ->get();
                    }
                }
            } else {
                $comment = CommentModel::query()
                    ->join('post', 'comment.PostId', '=', 'post.id')
                    ->where('post.slug', $slug)
                    ->where('comment.ParentId', null)
                    ->select('comment.*')
                    ->limit($limit)
                    ->get();
            }

            foreach ($comment as $comment) {
                $arr = [
                    'id' => $comment->id,
                    'PostId' => $comment->PostId,
                    'UserId' => $comment->UserId,
                    'name' => $comment->user->name,
                    'ParentId' => $comment->ParentId,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans($now),
                    'updated_at' => $comment->updated_at,
                ];
                array_push($cmt, $arr);
            }

            foreach ($info->rep as $reply) {
                $arr = [
                    'id' => $reply->id,
                    'PostId' => $reply->PostId,
                    'UserId' => $reply->UserId,
                    'name' => $reply->user->name,
                    'ParentId' => $reply->ParentId,
                    'content' => $reply->content,
                    'created_at' => $reply->created_at->diffForHumans($now),
                    'updated_at' => $reply->updated_at,
                ];
                array_push($rep, $arr);
            }
            $json['info'] = $info;
            $json['session'] = Auth::user();
            $json['cmt'] = $cmt;
            $json['rep'] = $rep;
            echo json_encode($json);
        }
    }
}