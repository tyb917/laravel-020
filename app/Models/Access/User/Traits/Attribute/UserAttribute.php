<?php

namespace App\Models\Access\User\Traits\Attribute;

use Config;
use Image;

/**
 * Class UserAttribute
 * @package App\Models\Access\User\Traits\Attribute
 */
trait UserAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        //创始人不能编辑
        if ($this->id>1) {
            return '<a href="' . route('admin.access.user.edit', $this->id) . '" class="btn btn-xs blue"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //创始人不能编辑
        if ($this->id>1) {
            return '<a href="' . route('admin.access.user.destroy', $this->id) . '" data-method="delete" class="btn btn-xs red"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i></a>';
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