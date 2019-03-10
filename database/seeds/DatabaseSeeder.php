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
        $this->call(PermissionAndRoleSeeder::class);

        $this->command->info('Generating users');
        $user = factory(App\User::class)->create([
             'control_id' => 5,
             'student_id' => 'xy12345'
         ]);

        $user->givePermissionTo('bypass-maintenance');
        $admin = factory(App\User::class)->create([
             'email' => 'admin@example.com',
         ]);
        $admin->givePermissionTo('bypass-maintenance');
        $admin->givePermissionTo('view-as-student');
        $admin->givePermissionTo('act-as-super-admin');




        User::where('email', 'admin@example.com')->first()->givePermissionTo('act-as-admin');

        $this->command->info('Framework seeding complete. Please run php artisan module:seed to seed any modules.');
    }
}
