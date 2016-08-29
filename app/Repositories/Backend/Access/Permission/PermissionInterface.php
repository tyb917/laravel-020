<?php

namespace App\Repositories\Backend\Access\Permission;

use App\Models\Access\Permission\Permission;

/**
 * Interface PermissionInterface
 * @package App\Repositories\Permission
 */
interface PermissionInterface
{
	/**
	 * 获取Datatable数据
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getForDataTable();

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllPermissions($order_by = 'id', $sort = 'asc');

    /**
     * 创建权限
     *
     * @param  $input
     * @return mixed
     */
    public function create($input);

    /**
     * 更新权限
     *
     * @param  Permission   $permission
     * @param  $input
     * @return mixed
     */
    public function update(Permission $permission, $input);

    /**
     * 删除权限
     *
     * @param  Permission   $permission
     * @return mixed
     */
    public function destroy(Permission $permission);


}