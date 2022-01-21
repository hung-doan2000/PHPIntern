<?php
namespace Database\Seeders;
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
        DB::table('roles')->where('name', 'Admin')->delete();

        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);

        $role = DB::table('roles')->where('name', '=', 'Admin')->get();

        $users = DB::table('users')->where('email', '=', 'hungdoan0401@gmail.com')->get();

        $roleUser = [
            'user_id' => $users[0]->id,
            'role_id' => $role[0]->id
        ];
        DB::table('role_user')->insert($roleUser);

    }
}
