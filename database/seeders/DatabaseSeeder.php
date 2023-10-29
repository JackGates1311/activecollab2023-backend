<?php

namespace Database\Seeders;

use App\Models\Labels;
use App\Models\TaskLists;
use App\Models\Tasks;
use App\Models\Users;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        TaskLists::factory(5)->create();
        Tasks::factory(20)->create();
        Labels::factory(10)->create();
        Users::factory(5)->create();
    }
}
