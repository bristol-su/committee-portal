<?php

use Illuminate\Database\Seeder;
use App\User;

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
        factory(App\User::class)->create([
             'control_id' => 5,
             'student_id' => 'xy12345'
         ]);
        factory(App\User::class)->create([
             'email' => 'admin@example.com',
         ]);

        $this->call(PermissionAndRoleSeeder::class);

        User::where('email', 'admin@example.com')->get()->first()->givePermissionTo('act-as-admin');

        $this->command->info('Framework seeding complete. Please run php artisan module:seed to seed any modules.');
    }
}
