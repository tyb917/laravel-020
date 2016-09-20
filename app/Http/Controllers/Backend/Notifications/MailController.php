<?php

namespace App\Http\Controllers\Backend\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Access\User\User;
use App\Notifications\MailNotification;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   dd('我是邮件通知');
        //单发邮件通知
        // $user = Auth::user();
        // $user->notify(new MailNotification);
        //群发邮件通知
        //$users = User::all();
        //Notification::send($users, new MailNotification);
        //群发延迟队列通知（使用队列必须开启执行队列工人--php artisan queue:work）
        // $users = User::all();
        // $when = Carbon::now()->addMinutes(1);
        // Notification::send($users, (new MailNotification())->delay($when));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
