<?php

namespace App\Http\Controllers\Backend\Access;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\Permission\PermissionRequest;
use App\Http\Requests\Backend\Access\Permission\PermissionStoreOrUpdateRequest;
use App\Models\Access\Permission\Permission;
use App\Repositories\Backend\Access\Permission\PermissionInterface;
use App\Repositories\Backend\Access\Role\RoleInterface;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    protected $permissions;
    protected $roles;

    public function __construct(PermissionInterface $permissions, RoleInterface $roles)
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.permission.index');
    }

    /**
     * 获取Datatables数据
     *
     * @param  PermissionRequest $request
     * @return array
     */
    public function get(PermissionRequest $request)
    {
        return Datatables::of($this->permissions->getForDataTable())
            ->addColumn('actions', function($permission) {
                return $permission->action_buttons;
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
        return view('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreOrUpdateRequest $request)
    {
        $this->permissions->create($request->all());
        return redirect()->route('admin.access.permission.index')->withFlashSuccess('权限创建成功');
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
    public function edit(Permission $permission)
    {
        return view('backend.permission.edit')
            ->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Permission $permission, PermissionStoreOrUpdateRequest $request)
    {
        $this->permissions->update($permission, $request->all());
        return redirect()->route('admin.access.permission.index')->withFlashSuccess('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->permissions->destroy($permission);
        return redirect()->route('admin.access.permission.index')->withFlashSuccess('删除成功');
    }
}
