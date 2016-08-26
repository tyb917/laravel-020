<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
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
            DB::table(config('entrust.permissions_table'))->truncate();
            DB::table(config('entrust.permission_role_table'))->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM ' . config('entrust.permissions_table'));
            DB::statement('DELETE FROM ' . config('entrust.permission_role_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('entrust.permissions_table') . ' CASCADE');
            DB::statement('TRUNCATE TABLE ' . config('entrust.permission_role_table') . ' CASCADE');
        }

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php
         */

        /**
         * Misc Access Permissions
         */
        $permission_model          = config('entrust.permission');
        $viewBackend               = new $permission_model;
        $viewBackend->name         = 'view-backend';
        $viewBackend->display_name = '访问后台';
        $viewBackend->description  = '访问后台';
        $viewBackend->created_at   = Carbon::now();
        $viewBackend->updated_at   = Carbon::now();
        $viewBackend->save();

        /**
         * Access Permissions
         */
        $permission_model          = config('entrust.permission');
        $manageRoles               = new $permission_model;
        $manageRoles->name         = 'manage-roles';
        $manageRoles->display_name = '管理角色';
        $manageRoles->description  = '管理角色';
        $manageRoles->created_at   = Carbon::now();
        $manageRoles->updated_at   = Carbon::now();
        $manageRoles->save();

        $permission_model          = config('entrust.permission');
        $manageUsers               = new $permission_model;
        $manageUsers->name         = 'manage-users';
        $manageUsers->display_name = '管理用户';
        $manageUsers->description  = '管理用户';
        $manageUsers->created_at   = Carbon::now();
        $manageUsers->updated_at   = Carbon::now();
        $manageUsers->save();

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
