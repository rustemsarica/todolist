<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todolist;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Todolist::factory(10)->create();
    }
}
