<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        Category::create([
            'name' => 'Summer Clothes',
            'description' => 'She’s here…Summer 2021!',
            'photo' => 'https://i.pinimg.com/564x/6e/fb/43/6efb43fe6ce2225bc9f0b8706dd3d365.jpg',
            'tax' => '10',
            'unit' => 'chiếc',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        Category::create([
            'name' => 'Winter Clothes',
            'description' => 'Discover the beauty of winter.',
            'photo' => 'https://img.joomcdn.net/31732438b745f05b4eb4da7bc1fed354768d4942_original.jpeg',
            'tax' => '10',
            'unit' => 'chiếc',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        Category::create([
            'name' => 'Accessories',
            'description' => 'Be the Inspiration',
            'photo' => 'https://media.istockphoto.com/photos/mens-accessories-organized-on-table-in-knolling-arrangement-picture-id638385938',
            'tax' => '10',
            'unit' => 'chiếc',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        Category::create([
            'name' => 'Bag',
            'description' => 'She’s here…Summer 2021!',
            'photo' => '4.png',
            'tax' => '10',
            'unit' => 'Cái',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        Category::create([
            'name' => 'T-Shirt',
            'description' => 'She’s here…Summer 2021!',
            'photo' => '5.png',
            'tax' => '10',
            'unit' => 'Cái',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        Category::create([
            'name' => 'Shoes',
            'description' => 'She’s here…Summer 2021!',
            'photo' => '6.png',
            'tax' => '20',
            'unit' => 'Đôi',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        Category::create([
            'name' => 'Coat',
            'description' => 'She’s here…Summer 2021!',
            'photo' => '7.png',
            'tax' => '15',
            'unit' => 'Cái',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

    }
}
