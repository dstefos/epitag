<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Check if there is already an admin and if not then create one
        $numberOfAdmins=\App\Models\User::where('admin', true)->count();
        if($numberOfAdmins==0)
        DB::table('users')->insert([
            'name' => "Adminios Adminidis",
            'email' => "admin@epitages.gr",
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'), // password
            'admin' => true,
            'balance' => 0,
            'remember_token' => Str::random(10),
        ]);

        // Create 10 users
        \App\Models\User::factory(10)->create();
        $this->call([
            CardSeeder::class,
            BundleSeeder::class,
        ]);
    }
}
