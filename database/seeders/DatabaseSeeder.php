<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Teacher;
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
        Administrator::factory()->count(5)->create();
        Teacher::factory()->count(30)->create();
    }
}
