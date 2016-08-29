<?php

namespace App\Http\Controllers\Backend\Access;

use Illuminate\Http\Request;
use App\Models\Access\Role\Role;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Access\Role\RoleRequest;
use App\Http\Requests\Backend\Access\Role\RoleStoreOrUpdateRequest;
use App\Repositories\Backend\Access\Role\RoleInterface;
use App\Repositories\Backend\Access\Permission\PermissionInterface;

class RoleController extends Controller
{
    protected $roles;
    protected $permissions;

    public function __construct(RoleInterface $roles, PermissionInterface $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.role.index');
    }

    /**
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function get(RoleRequest $request)
    {
        return Datatables::of($this->roles->getForDataTable())
            ->addColumn('permissions', function($role) {
                $permissions = [];

                if ($role->all)
                    return '<span class="label lable-sm bg-blue">全部</span>';

                if (count($role->permissions) > 0) {
                    foreach ($role->permissions as $permission) {
                        array_push($permissions, $permission->display_name);
                    }

                    return implode("<br/>", $permissions);
                } else {
                    return '<span class="label lable-sm bg-red">暂无</span>';
                }
            })
            ->addColumn('users', function($role) {
                return $role->users()->count();
            })
            ->addColumn('actions', function($role) {
                return $role->action_buttons;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create')
            ->withPermissions($this->permissions->getAllPermissions())
            ->withRoleCount($this->roles->getCount());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreOrUpdateRequest $request)
    {
        $this->roles->create($request->all());
        return redirect()->route('admin.access.role.index')->withFlashSuccess('权限创建成功');
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
    public function edit(Role $role)
    {
        return view('backend.role.edit')
            ->withRole($role)
            ->withRolePermissions($role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, RoleStoreOrUpdateRequest $request)
    {
        $this->roles->update($role, $request->all());
        return redirect()->route('admin.access.role.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->roles->destroy($role);
        return redirect()->route('admin.access.role.index')->withFlashSuccess('删除成功');
    }
}
