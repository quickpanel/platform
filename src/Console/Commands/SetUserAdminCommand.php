<?php

namespace QuickPanel\Platform\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use QuickPanel\Platform\Models\Admin;

class SetUserAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:set-user-admin-command';

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
        $userId = $this->ask('AdminId');
        try {
            $user = Admin::findOrFail($userId);
            $user->assignRole('administrator');
            $this->info('Admin Set as Administrator');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}
