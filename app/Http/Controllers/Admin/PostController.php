<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class PostController extends BaseController{

    public function index( Request $request ){
        $query = Post::where( 'title', '!=', '' );

        if( !empty( $request['search_text'] ) ){
            $query = $query->where('title', 'LIKE', '%'. $request['search_text'] . '%');
        }

        $posts = $query->orderBy('updated_at', 'desc')->paginate(15);

        return view("/backend/post/index", compact('posts', 'request'));
    }

    public function show( $id ){
        $post = Post::find($id);

        return view("/backend/post/show", compact( 'post' ));
    }

    public function create(){
        return view("/backend/post/create");
    }

    public function store( Request $request ){
        $data = $request->all();

        $post = Post::create($data);

        return redirect()->route('post.index');
    }

    public function edit( $id ){
        $post = Post::find($id);

        return view("/backend/post/edit", compact( 'post' ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $post = Post::find($id)->update($data);

        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('post.index');
    }
}
