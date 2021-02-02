<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\User;
use Validator;

class PagesController extends BaseController{

    public function index( Request $request ){
        $query = Page::where( 'title', '!=', '' );

        if( !empty( $request['search_text'] ) ){
            $query = $query->where('title', 'LIKE', '%'. $request['search_text'] . '%');
        }

        $pages = $query->orderBy('updated_at', 'desc')->paginate(5);

        return view("/backend/pages/index", compact('pages', 'request'));
    }

    public function show( $id ){
        $page = Page::find($id);

        return view("/backend/pages/show", compact( 'page' ));
    }

    public function create(){
        return view("/backend/pages/create");
    }

    public function store( Request $request ){

        $rules = [
            'title' => 'required|unique:pages',
            'content' => 'required'
        ];
        $messages = [
            'title.required' => 'Tiêu đề Không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'content.required' => 'Nội dung không thể để trống',
        ];

        $arraySlug = array("login", "login-guest", "tra-cuu", "tra-cuu-hd", '404-page', 'logout', 'logout-guest', 'reload-captcha-code');
        $validator = Validator::make($request->all(), $rules, $messages);

        $input = $request->all();

        if ($validator->fails()) {
            return redirect()->route('pages.create', ['input' => $input])->withErrors($validator)
                             ->with('error', 'Tiêu đề và Nội dung không thể trống hoặc tiêu đề đã tồn tại.');
        } else {
            $input['slug'] = Page::forwardNameToUrl($request['title']);

            $slug = Page::where("slug", $input['slug'])->first();

            if ( !empty($slug) || empty($input['slug']) || in_array($input['slug'] , $arraySlug)  )
            {
                return redirect()->route('pages.create', ['input' => $input])->with('error', 'Tiêu đề đã tồn tại hoặc từ khóa cấm.');
            }
            $page = Page::create($input);
        }
        return redirect()->route('pages.index');
    }

    public function edit( $id ){
        $page = Page::find($id);

        return view("/backend/pages/edit", compact( 'page' ));
    }

    public function update(Request $request, $id)
    {
        $page = Page::where("title", $request['title'])->where("id", "!=", $id)->first();
        $arraySlug = array("login", "login-guest", "tra-cuu", "tra-cuu-hd", '404-page', 'logout', 'logout-guest', 'reload-captcha-code');

        if (!empty($page)) {
            return redirect()->route('pages.edit', ['page' => $id])->with('error', 'Tiêu đề đã tồn tại.');
        }else {
            $data = $request->all();
            $data['slug'] = Page::forwardNameToUrl($request['title']);

            $slug = Page::where("slug", $data['slug'])->where("id", "!=", $id)->first();

            if ( !empty($slug) || empty($data['slug']) || in_array($data['slug'] , $arraySlug) )
            {
                return redirect()->route('pages.edit', ['page' => $id])->with('error', 'Tiêu đề đã tồn tại hoặc từ khóa cấm.');
            }

            $page = Page::find($id)->update($data);
        }
        return redirect()->route('pages.index');
    }

    public function destroy($id)
    {
        Page::find($id)->delete();
        return redirect()->route('pages.index');
    }
}
