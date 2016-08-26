<?php 

namespace App\Models\Access\Role;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\Role\Traits\RoleAccess;
use App\Models\Access\Role\Traits\Attribute\RoleAttribute;
use App\Models\Access\Role\Traits\Relationship\RoleRelationship;

class Role extends EntrustRole
{
	use Notifiable, RoleAccess, RoleAttribute, RoleRelationship;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'all', 'sort'];
}