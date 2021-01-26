<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class AccountController extends BaseController{

    public function index( Request $request ){
        $query = User::where( 'name', '!=', '' );

        if( !empty( $request['search_text'] ) ){
            $query = $query->where('name', 'LIKE', '%'. $request['search_text'] . '%');
        }

        $users = $query->orderBy('updated_at', 'desc')->paginate(15);

        return view("/backend/account/index", compact('users', 'request'));
    }

    public function show( $id ){
        $post = Post::find($id);

        return view("/backend/account/show", compact( 'post' ));
    }

    public function create(){
        $roles = User::roleArr();
        return view("/backend/account/create", compact('roles'));
    }

    public function store( Request $request ){
        $data = $request->all();

        $post = Post::create($data);

        return redirect()->route('account.index');
    }

    public function edit( $id ){
        $post = Post::find($id);

        return view("/backend/post/edit", compact( 'post' ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $post = Post::find($id)->update($data);

        return redirect()->route('account.index');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('account.index');
    }
}

