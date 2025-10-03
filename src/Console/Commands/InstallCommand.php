<?php

namespace QuickPanel\Platform\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Quick Setup Install Command');
        $this->info('Creating Roles, Permissions and Admin');
        $this->info('Create Roles');
        Artisan::call(CreateRolesCommand::class);
        $this->info('Create Permissions');
        Artisan::call(CreatePermissionsCommand::class);
    }
}
