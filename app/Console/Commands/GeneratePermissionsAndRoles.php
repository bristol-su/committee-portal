<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// TODO This functionality should be put into a migration

class GeneratePermissionsAndRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all permissions and roles required by the modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:seed', [
            '--class' => 'PermissionAndRoleSeeder'
        ]);

        $this->call('module:seed', [
            '--class' => 'PermissionAndRoleSeeder'
        ]);
    }
}
