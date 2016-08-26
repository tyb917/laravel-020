<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
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
            DB::table(config('entrust.roles_table'))->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM ' . config('entrust.roles_table'));
            DB::statement('UPDATE sqlite_sequence SET seq = 0 where name = ' ."'". config('entrust.roles_table')."'");

        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('entrust.roles_table') . ' CASCADE');
        }

        $roles = [
            [
                'name' => 'Root',
                'display_name' => '创始人',
                'description' => '网站全部权限',
                'all' => true,
                'sort' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Administrator',
                'display_name' => '管理员',
                'description' => '网站大部分权限',
                'all' => true,
                'sort' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'User',
                'display_name' => '用户',
                'description' => '用户',
                'all' => false,
                'sort' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table(config('entrust.roles_table'))->insert($roles);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
