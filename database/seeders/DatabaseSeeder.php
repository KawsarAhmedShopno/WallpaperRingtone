<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'classical']);
        Category::create(['name' => 'Android']);
        Category::create(['name' => 'Animals']);
        Category::create(['name' => 'Music']);
        Category::create(['name' => 'Funny']);
        Category::create(['name' => 'Instrumental']);

        User::create(['name' => 'admin', 'email' => 'kaw@gmail.com', 'password' => bcrypt('123456789'), 'email_verified_at' => now()]);
    }
}
