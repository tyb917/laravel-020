<?php

use Illuminate\Database\Seeder;
use App\Models\Access\Role\Role;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		}

		if (DB::connection()->getDriverName() == 'mysql') {
			DB::table(config('entrust.permission_role_table'))->truncate();
		} elseif (DB::connection()->getDriverName() == 'sqlite') {
			DB::statement('DELETE FROM ' . config('entrust.permission_role_table'));
		} else {
			//For PostgreSQL or anything else
			DB::statement('TRUNCATE TABLE ' . config('entrust.permission_role_table') . ' CASCADE');
		}

		/**
		 * 角色管理默认权限
		 */
		Role::find(3)->permissions()->sync([1, 2]);

		/**
		 * 用户管理默认权限
		 */
		Role::find(4)->permissions()->sync([1, 3]);

		if (DB::connection()->getDriverName() == 'mysql') {
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		}
    }
}
