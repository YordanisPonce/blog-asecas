<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //User::create(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => 'adminadmin']);
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}