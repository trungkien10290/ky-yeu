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
            AdminTablesSeeder::class,
            PermissionSeeder::class,

        ]);
        system('php artisan admin:generate-menu');
        if (app()->environment('local')) {
            $this->call([
                CategorySeeder::class,
                ProjectSeeder::class,
                BugSeeder::class,
                BannerSeeder::class
            ]);
        }

    }
}
