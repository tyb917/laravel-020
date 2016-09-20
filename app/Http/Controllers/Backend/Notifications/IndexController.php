<?php

namespace App\Http\Controllers\Backend\Notifications;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        dd('我是通知首页');
    }
}
