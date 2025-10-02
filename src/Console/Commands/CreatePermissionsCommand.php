<?php

namespace QuickPanel\Platform\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:create-permissions-command';

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
        App::setLocale('en');
        $user = Role::findByName('user');
        $permissions_user = __('platform::permissions.user');

        foreach ($permissions_user as $permission => $translate) {
            Permission::create(
                ['name' => $permission]
            );
        }

        foreach ($permissions_user as $permission => $translate) {
            $user->givePermissionTo($permission);
        }

        $administrator = Role::findByName('administrator', 'admin');
        $permissions_administrator = __('platform::permissions.administrator');

        foreach ($permissions_administrator as $permission => $translate) {
            Permission::create(
                ['name' => $permission, 'guard_name' => 'admin']
            );
        }

        foreach ($permissions_administrator as $permission => $translate) {
            $administrator->givePermissionTo($permission);
        }


    }
}
