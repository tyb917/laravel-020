<?php

namespace App\Http\Controllers\Backend\Access;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Backend\Access\User\UserRequest;
use App\Http\Requests\Backend\Access\User\UserStoreOrUpdateRequest;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\Permission\PermissionInterface;
use App\Repositories\Backend\Access\Role\RoleInterface;
use App\Repositories\Backend\Access\User\UserInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    private $users;
    private $roles;
    private $permissions;

    public function __construct(UserInterface $users, RoleInterface $roles, PermissionInterface $permissions)
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }



    /**
     * 用户列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.user.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(UserRequest $request)
    {
        return Datatables::of($this->users->getForDataTable())
            ->addColumn('role', function($user) {
                $roles = [];

                if ($user->roles()->count() > 0) {
                    foreach ($user->roles as $role) {
                        array_push($roles, $role->name);
                    }

                    return implode("<br/>", $roles);
                } else {
                    return '暂无';
                }
            })
            ->addColumn('actions', function($user) {
                return $user->action_buttons;
            })
        ->make(true);
    }

    /**
     * 创建用户表单页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.user.create')
            ->withRoles($this->roles->getAllRoles());
    }

    /**
     * 创建用户
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreOrUpdateRequest $request)
    {
        $this->users->create($request->all());
        return redirect()->route('admin.access.user.index')->withFlashSuccess('管理员创建成功');
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
     * 编辑页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.access.user.edit')
            ->withUser($user)
            ->withRoles($this->roles->getAllRoles())
            ->withRoleUser($user->roles->pluck('id')->all());
    }

    /**
     * 更新数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreOrUpdateRequest $request)
    {
        $this->users->update($request->all());
        return redirect()->route('admin.access.user.index')->withFlashSuccess('更新成功');
        
    }

    /**
     * 删除数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->users->destroy($id);
        return redirect()->back()->withFlashSuccess('删除成功');
    }
}
