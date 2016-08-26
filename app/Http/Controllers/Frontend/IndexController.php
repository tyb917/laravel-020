<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
    	// $user = \App\User::first();
    	// $test = \App\User::first();
    	// $user->notify(new EmailPublished($test));
        return view('frontend.index');
    }

}
