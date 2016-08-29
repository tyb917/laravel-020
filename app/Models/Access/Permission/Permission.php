<?php 

namespace App\Models\Access\Permission;

use Zizaco\Entrust\EntrustPermission;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;

class Permission extends EntrustPermission
{
	use Notifiable, PermissionAttribute, PermissionRelationship;

	/**
	 * 白名单
	 * @var array
	 */
	protected $fillable = ['name', 'display_name', 'description'];
}