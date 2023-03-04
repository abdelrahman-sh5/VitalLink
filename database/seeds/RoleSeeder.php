<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role       = 'admin';
        $permission = 'posts-create';
        $role->givePermissionTo($permission);
    }
}
