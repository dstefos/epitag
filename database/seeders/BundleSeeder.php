<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Bundle::factory()->count(3)->create();
    }
}
