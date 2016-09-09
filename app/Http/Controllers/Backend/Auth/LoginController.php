<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';
    protected $username;
    protected $guard = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
        $this->username = 'mobile';
    }

	/**
	 * 登录视图
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * 自定义登录校验的字段
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * 退出登录
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * 获得身份验证过程中使用的guard。
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
