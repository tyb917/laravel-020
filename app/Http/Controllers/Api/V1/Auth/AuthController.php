<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\UserRequest;
use App\Models\Access\User\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * 登录
     *
     * @param  Illuminate\Http\Request $request
     * @return response
     * 
     */
    public function authenticate(Request $request)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', env('APP_URL').'oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('API_CLIENT_ID'),
                'client_secret' => env('API_CLIENT_SECRET'),
                'username' => $request->username,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function register(UserRequest $request)
    {
    	$user = User::create([
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
        ]);
        // 创建用户成功
        if ($user) {
            return response()->json(['success' => '创建用户成功']);
        } else {
            return response()->json(['error' => '创建用户失败']);
        }
    }
}
