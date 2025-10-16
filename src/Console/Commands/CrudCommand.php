<?php

namespace QuickPanel\Platform\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use QuickPanel\Platform\Models\Admin;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:crud {namespace} {model}';

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
        $names = $this->argument('namespace');
        $model = $this->argument('model');


        $this->info('Crud Command');

    }
}
