<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminLoginController extends Controller
{
    //
    public function login()
    {
        return view('admins.login_logout.login');
    }

    public function loginProcess(Request $request)
    {
        $account = $request->only(['email', 'password']);
        $check = Auth::guard('admin')->attempt($account);

        if ($check) {
            //Lấy thông tin của customer đang login
            $admin = Auth::guard('admin')->user();
            //Cho login
            Auth::guard('admin')->login($admin);
            //Ném thông tin customer đăng nhập lên session
            session(['admin' => $admin]);
            return Redirect::route('dashboard.index');
        } else {
            //cho quay về trang login
            return Redirect::back();
        }
    }
}
