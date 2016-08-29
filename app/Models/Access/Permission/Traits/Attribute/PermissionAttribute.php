<?php

namespace App\Models\Access\Permission\Traits\Attribute;

/**
 * Class RoleAttribute
 * @package App\Models\Access\Permission\Traits\Attribute
 */
trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="' . route('admin.access.permission.edit', $this) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        /**
         * 不能删除系统权限
         */
        if ($this->id > 3) {
            return '<a href="' . route('admin.access.permission.destroy', $this) . '" class="btn btn-xs red" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }
}