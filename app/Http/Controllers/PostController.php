<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use App\Models\PostModel;

class PostController extends Controller
{
    //
    public function index()
    {
        $post = DB::table('post')->get();
        return view('Admin.post.posts', [
            'index' => 1,
            'post' => $post,
        ]);
    }
    public function indexUser()
    {
        // if(!Auth()->user() || Auth()->user()->hasRole('User')){}
        return view('User.posts');
    }

    public function getInfoPost(Request $request)
    {
        $current_page = $request->get('page') ? $request->get('page') : 1;
        $limit = 3;
        $paginate = DB::table('post')
            ->paginate($limit);
        $post = DB::table('post')
            ->limit($limit)->offset(($current_page - 1) * $limit)->get();
        $json['post'] = $post;
        $json['paginate'] = $paginate;
        echo json_encode($json);
    }

    public function create()
    {
        return view('Admin.post.create');
    }

    public function store(Request $request)
    {
        $title = $request->get('title');
        $slug = $request->get('slug');
        $description = $request->get('description');
        $content = $request->get('editor');
        $author = Auth::user()->id;
        if ($title != null && $slug != null && $description != null && $content != null) {
            $data = DB::table("post")
                ->insert([
                    "title" => $title,
                    "slug" => $slug,
                    "description" => $description,
                    "content" => $content,
                    "author" => $author,
                ]);
            return redirect()->back()->with('alert', 'Đăng bài thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Đăng bài không thành công');
        }
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $request->file('upload')->storeAs('public/storage/uploads', $filenametostore);
            $request->file('upload')->storeAs('public/storage/uploads/thumbnail', $filenametostore);
            $thumbnailpath = public_path('storage/uploads/thumbnail/' . $filenametostore);
            $img = Image::make($thumbnailpath)->resize(500, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
            echo json_encode([
                'default' => asset('storage/uploads/' . $filenametostore),
                '500' => asset('storage/uploads/' . $filenametostore)
            ]);
        }
    }
    public function edit(Request $request, $id)
    {

        $info = DB::table('post')
            ->where('id', $id)
            ->first();
        return view('Admin.post.updatePost', [
            'post' => $info,
        ]);
    }
    public function update(Request $request, $id)
    {
        $title = $request->get('title');
        $slug = $request->get('slug');
        $description = $request->get('description');
        $content = $request->get('editor');
        if ($title != null && $slug != null && $description != null && $content != null) {
            $data = DB::table("post")
                ->where('id', $id)
                ->update([
                    "title" => $title,
                    "slug" => $slug,
                    "description" => $description,
                    "content" => $content,
                ]);
            return redirect()->back()->with('alert', 'Thay đổi bài thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Thay đổi bài không thành công');
        }
    }
    public function delete($id)
    {
        $getInfo = CommentModel::find($id);
        if ($getInfo >= 1) {
            $deleteComment = CommentModel::where('PostId', $id)->firstorfail()->delete();
            $deletePost = PostModel::where('id', $id)->firstorfail()->delete();
            return redirect()->back()->with('alert', 'Xóa thành công');
        } else {
            $deletePost = PostModel::where('id', $id)->firstorfail()->delete();
            return redirect()->back()->with('alert', 'Xóa thành công');
        }
    }
}