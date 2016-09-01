<?php

namespace App\Repositories\Backend\Access\Role;

use Entrust;
use App\Models\Access\Role\Role;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class RoleRepository
 * @package app\Repositories\Role
 */
class RoleRepository implements RoleInterface
{
    
	/**
     * @return mixed
     */
    public function getCount() {
        return Role::count();
    }

	/**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getForDataTable() {
        return Role::all();
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @param  bool    $withPermissions
     * @return mixed
     */
    public function getAllRoles($order_by = 'sort', $sort = 'asc', $withPermissions = false)
    {
        if ($withPermissions) {
            return Role::with('permissions')
                ->orderBy($order_by, $sort)
                ->get();
        }

        return Role::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @throws Exception
     * @return bool
     */
    public function create($input)
    {
		if (Role::where('name', $input['name'])->first()) {
			throw new GeneralException('角色名称已存在！');
		}

		//See if the role has all access
		$all = $input['associated-permissions'] == 'all' ? true : false;

		if (! isset($input['permissions']))
			$input['permissions'] = [];

		//This config is only required if all is false
		if (! $all) {
			//See if the role must contain a permission as per config
			if (config('entrust.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
				throw new GeneralException('您必须为这个角色至少选择一个权限！');
			}
		}

		DB::transaction(function() use ($input, $all) {
	       	$role = new Role;
			$role->name = $input['name'];
			$role->display_name = $input['display_name'];
			$role->description = $input['description'];
			$role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int)$input['sort'] : 0;
			$role->all = $all;

			if ($role->save()) {
				if (!$all) {
					$permissions = [];

					if (is_array($input['permissions']) && count($input['permissions'])) {
						foreach ($input['permissions'] as $perm) {
							if (is_numeric($perm)) {
								array_push($permissions, $perm);
							}
						}
					}

					$role->attachPermissions($permissions);
				}

				return true;
			}

			throw new GeneralException('角色创建失败！');
		});
    }

    /**
     * @param  Role $role
     * @param  $input
     * @throws Exception
     * @return bool
     */
    public function update(Role $role, $input)
    {
    	if ($role->id < 4) {
            throw new GeneralException('不能更改系统默认权限！');
        }
        
        //See if the role has all access, administrator always has all access
        if ($role->id == 1 || $role->id == 2) {
            $all = true;
        } else {
            $all = $input['associated-permissions'] == 'all' ? true : false;
        }

        if (! isset($input['permissions']))
            $input['permissions'] = [];

        //This config is only required if all is false
        if (! $all) {
            //See if the role must contain a permission as per config
            if (config('entrust.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new Exception('您必须为这个角色至少选择一个权限！');
            }
        }

		$role->name = $input['name'];
		$role->display_name = $input['display_name'];
		$role->description = $input['description'];
		$role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int)$input['sort'] : 0;
		$role->all = $all;

		DB::transaction(function() use ($role, $input, $all) {
			if ($role->save()) {
				//If role has all access detach all permissions because they're not needed
				if ($all) {
					$role->permissions()->sync([]);
				} else {
					//Remove all roles first
					$role->permissions()->sync([]);

					//Attach permissions if the role does not have all access
					$permissions = [];

					if (is_array($input['permissions']) && count($input['permissions'])) {
						foreach ($input['permissions'] as $perm) {
							if (is_numeric($perm)) {
								array_push($permissions, $perm);
							}
						}
					}

					$role->attachPermissions($permissions);
				}

				return true;
			}

			throw new GeneralException('角色更新失败！');
		});
    }

    /**
     * @param  Role $role
     * @throws Exception
     * @return bool
     */
    public function destroy(Role $role)
    {
        if ($role->id < 4) {
            throw new GeneralException('不能删除系统默认角色！');
        }

		DB::transaction(function() use ($role) {
			//Detach all associated roles
			$role->permissions()->sync([]);

			if ($role->delete()) {
				return true;
			}

			throw new GeneralException('角色删除失败！');
		});
    }

	/**
	 * @return mixed
	 */
	public function getDefaultUserRole() {
		if (is_numeric(config('access.users.default_role'))) {
			return Role::where('id', (int) config('access.users.default_role'))->first();
		}
		return Role::where('name', config('access.users.default_role'))->first();
	}
}