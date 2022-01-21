<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Database\Seeders\UserTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
