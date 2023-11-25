<?php

namespace Database\Seeders;

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
        $this->call([
            InfoSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
            ThanaSeeder::class,
            DesignationSeeder::class,
            KeywordSeeder::class,
            DvisionWeSeeder::class,
            CMSSeeder::class,
        ]);
    }
}
