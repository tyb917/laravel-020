<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Access\User\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

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
        $this->username = 'username';
    }

	/**
	 * 后台登录视图
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * 获得身份验证过程中使用的admin守卫。
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
