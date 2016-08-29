<?php

namespace App\Repositories\Backend\Access\Permission;

use Entrust;
use App\Models\Access\Permission\Permission;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class PermissionRepository
 * @package App\Repositories\Permission
 */
class PermissionRepository implements PermissionInterface
{
	/**
	 * 取Datatable数据
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
    public function getForDataTable() {
        return Permission::all();
    }

	/**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllPermissions($order_by = 'id', $sort = 'asc')
    {
        return Permission::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * 创建权限
     *
     * @param  $input
     * @throws Exception
     * @return bool
     */
    public function create($input)
    {
        if (Permission::where('name', $input['name'])->first()) {
            throw new GeneralException('权限名称已存在！');
        }

        DB::transaction(function() use ($input) {
            $permission = new Permission;
            $permission->name = $input['name'];
            $permission->display_name = $input['display_name'];
            $permission->description = $input['description'];

            if ($permission->save()) {
                return true;
            }

            throw new GeneralException('权限创建失败！');
        });
    }

    /**
     * 更新权限
     *
     * @param  Permission $permission [description]
     * @param  $input
     * @throws Exception
     * @return bool
     */
    public function update(Permission $permission, $input)
    {
        if ($permission->id < 3) {
            throw new GeneralException('不能更改系统默认权限！');
        }

        $permission->name = $input['name'];
        $permission->display_name = $input['display_name'];
        $permission->description = $input['description'];
        
        DB::transaction(function() use ($permission) {

            if ($permission->save()) {
                return true;
            }

            throw new GeneralException('权限更新失败！');
        });
    }


    /**
     * 删除权限
     *
     * @param  Permission $permission
     * @throws Exception
     * @return bool
     */
    public function destroy(Permission $permission)
    {
        if ($permission->id < 3) {
            throw new GeneralException('不能删除系统默认权限！');
        }

        DB::transaction(function() use ($permission) {

            if ($permission->delete()) {
                return true;
            }

            throw new GeneralException('权限删除失败！');
        });
    }
}