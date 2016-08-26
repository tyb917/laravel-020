<?php

namespace App\Repositories\Backend\Access\Permission;

use App\Models\Access\Permission\Permission;

/**
 * Class PermissionRepository
 * @package App\Repositories\Permission
 */
class PermissionRepository implements PermissionInterface
{

	/**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllPermissions()
    {
        return Permission::get();
    }
}