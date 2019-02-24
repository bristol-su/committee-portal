<?php

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
         $this->command->info('Generating users');
         factory(App\User::class)->create();

         $this->command->info('Framework seeding complete. Please run php artisan module:seed to seed any modules.');
    }
}
