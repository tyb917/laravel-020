<?php

namespace App\Repositories\Backend\Access\Permission;

/**
 * Interface PermissionInterface
 * @package App\Repositories\Permission
 */
interface PermissionInterface
{

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllPermissions();
}