<?php

use Illuminate\Database\Seeder;
use App\MyPermission;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\MyRole::where('name', 'admin')->get();
        $permission = MyPermission::where('name', 'posts-create')->get();
        $role->givePermissionTo($permission);
    }
}
