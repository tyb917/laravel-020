<?php

namespace App\Models\Access\Role\Traits\Relationship;

/**
 * Class RoleRelationship
 * @package App\Models\Access\Role\Traits\Relationship
 */
trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'), config('entrust.role_user_table'), config('entrust.role_foreign_key'), config('entrust.user_foreign_key'));
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(config('entrust.permission'), config('entrust.permission_role_table'), config('entrust.role_foreign_key'), config('entrust.permission_foreign_key'))
            ->orderBy('display_name', 'asc');
    }
}