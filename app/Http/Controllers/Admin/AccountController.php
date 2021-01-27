<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Page;
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
        $account = User::find($id);

        return view("/backend/account/show", compact( 'account' ));
    }

    public function create(){
        $roles = User::roleArr();
        return view("/backend/account/create", compact('roles'));
    }

    public function store( Request $request ){
        $data = $request->all();
        $data['password_real'] = $data['password'];
        $data['password'] = \Hash::make($data['password']);

        $account = User::create($data);

        return redirect()->route('account.index');
    }

    public function edit( $id ){
        $account = User::find($id);
        $roles = User::roleArr();
        $types = User::typeArr();
        return view("/backend/account/edit", compact( 'account','roles', 'types' ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $data['password_real'] = $data['password'];
        $data['password'] = \Hash::make($data['password']);
        if( empty($data['password_real']) )
        {
            unset( $data['password'] );
            unset( $data['password_real'] );
        }

        $account = User::find($id)->update($data);

        return redirect()->route('account.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('account.index');
    }
}

