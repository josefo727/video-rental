<?php

namespace Database\Seeders;

use App\Models\Collections;
use Illuminate\Database\Seeder;

class CollectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collections::factory()
            ->count(5)
            ->create();
    }
}
