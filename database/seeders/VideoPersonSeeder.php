<?php

namespace Database\Seeders;

use App\Models\VideoPerson;
use Illuminate\Database\Seeder;

class VideoPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoPerson::factory()
            ->count(5)
            ->create();
    }
}
