<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', '=', 'hungdoan0401@gmail.com');
        if ($user)
        {
            $user->delete();
        }

        User::create([
            'name' => 'admin',
            'email' =>'hungdoan0401@gmail.com',
            'image' =>'hungjr.png',
            'password' => bcrypt('123456')
        ]);

    }
}
