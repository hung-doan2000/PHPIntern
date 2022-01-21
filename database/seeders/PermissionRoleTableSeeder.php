<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = DB::table('roles')->where('name', '=', 'Admin')->get();

        $permissions = DB::table('permissions')->get();

        if ($permissions) {
            foreach ($permissions as $permission) {
                $data = [
                    'role_id' => $roleAdmin[0]->id,
                    'permission_id' => $permission->id,
                ];
                DB::table('permission_role')->insert($data);
            }
        }

    }
}
