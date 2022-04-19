<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        $list = User::query()
            ->with(
                'role'
            )
            ->get();

        return view('Admin.account.listAd', [
            'index' => 1,
            'list' => $list,
        ]);
    }

    public function create()
    {
        return view('Admin.account.createAd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $admin->assignRole('Admin', 'User');
        event(new Registered($admin));
        return redirect()->back()->with('alert', 'Thêm nhân viên thành công');
    }

    public function edit($id)
    {
        $getInfo = DB::table("users")->where('id', $id)->first();
        return view('Admin.account.update', [
            'info' => $getInfo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $name = $request->get("name");
        $email = $request->get("email");
        $password = $request->get("password");

        $data = DB::table("users")
            ->where('id', $id)
            ->update([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password),
            ]);
        return redirect()->back()->with('alert', 'Thay đổi thành công');
    }

    public function destroy($id)
    {
        // $relationships = array('comment', 'rep', 'role', 'post');

        // $user = User::find($id);
        // $should_delete = true;

        // foreach ($relationships as $r) {
        //     if ($user->$r->isNotEmpty()) {
        //         $should_delete = false;
        //         break;
        //     }
        // }

        // if ($should_delete == true) {
        //     $user->delete();
        //     return redirect()->back()->with('alert', 'Xóa thành công');
        // }
        $getInfo = CommentModel::find($id);
        if ($getInfo >= 1) {
            $deleteComment = CommentModel::where('UserId', $id)->firstorfail()->delete();
            $deleteUser = User::where('id', $id)->firstorfail()->delete();
            return redirect()->back()->with('alert', 'Xóa thành công');
        } else {
        }
        $deleteUser = User::where('id', $id)->firstorfail()->delete();
        return redirect()->back()->with('alert', 'Xóa thành công');
    }
}