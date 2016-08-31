<?php

namespace App\Models\Access\Role\Traits\Attribute;

/**
 * Class RoleAttribute
 * @package App\Models\Access\Role\Traits\Attribute
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        //系统权限不能编辑
        if ($this->id > 4) {
            return '<a href="' . route('admin.access.role.edit', $this) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //系统权限不能编辑
        if ($this->id > 4) {
            return '<a href="' . route('admin.access.role.destroy', $this) . '" class="btn btn-xs red" data-method="delete"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
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