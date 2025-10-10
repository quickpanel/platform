<?php

namespace QuickPanel\Platform;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class QuickPanelPlatformServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/platform.php', 'platform');
    }

    public function boot(): void
    {
        // Routes
        Route::middleware('web')->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/front.php');
            $this->loadRoutesFrom(__DIR__.'/../routes/auth.php');
            $this->loadRoutesFrom(__DIR__.'/../routes/user.php');
            $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        });


        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'platform');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'platform');

        // Register Livewire components
        Livewire::component('platform.administrator.auth.change-password', \QuickPanel\Platform\Livewire\Administrator\Auth\ChangePassword::class);
        Livewire::component('platform.administrator.auth.forget-password', \QuickPanel\Platform\Livewire\Administrator\Auth\ForgetPassword::class);
        Livewire::component('platform.administrator.auth.login', \QuickPanel\Platform\Livewire\Administrator\Auth\Login::class);
        Livewire::component('platform.administrator.auth.logout', \QuickPanel\Platform\Livewire\Administrator\Auth\Logout::class);
        Livewire::component('platform.administrator.dashboard.index', \QuickPanel\Platform\Livewire\Administrator\Dashboard\Index::class);
        Livewire::component('platform.administrator.setting-management.function.index', \QuickPanel\Platform\Livewire\Administrator\SettingManagement\Function\Index::class);
        Livewire::component('platform.administrator.setting-management.option.index', \QuickPanel\Platform\Livewire\Administrator\SettingManagement\Option\Index::class);
        Livewire::component('platform.administrator.user-management.admin.create', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Create::class);
        Livewire::component('platform.administrator.user-management.admin.edit', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Edit::class);
        Livewire::component('platform.administrator.user-management.admin.index', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Index::class);
        Livewire::component('platform.administrator.user-management.admin.permissions', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Permissions::class);
        Livewire::component('platform.administrator.user-management.admin.roles', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Roles::class);
        Livewire::component('platform.administrator.user-management.admin.table', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Table::class);
        Livewire::component('platform.administrator.user-management.permission.create', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Permission\Create::class);
        Livewire::component('platform.administrator.user-management.permission.edit', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Permission\Edit::class);
        Livewire::component('platform.administrator.user-management.permission.index', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Permission\Index::class);
        Livewire::component('platform.administrator.user-management.permission.table', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Permission\Table::class);
        Livewire::component('platform.administrator.user-management.role.create', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Create::class);
        Livewire::component('platform.administrator.user-management.role.edit', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Edit::class);
        Livewire::component('platform.administrator.user-management.role.index', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Index::class);
        Livewire::component('platform.administrator.user-management.role.permissions', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Permissions::class);
        Livewire::component('platform.administrator.user-management.role.table', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Table::class);
        Livewire::component('platform.administrator.user-management.role.users', \QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Users::class);
        Livewire::component('platform.administrator.user-management.user.create', \QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Create::class);
        Livewire::component('platform.administrator.user-management.user.edit', \QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Edit::class);
        Livewire::component('platform.administrator.user-management.user.index', \QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Index::class);
        Livewire::component('platform.administrator.user-management.user.permissions', \QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Permissions::class);
        Livewire::component('platform.administrator.user-management.user.roles', \QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Roles::class);
        Livewire::component('platform.administrator.user-management.user.table', \QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Table::class);
        Livewire::component('platform.auth.change-password', \QuickPanel\Platform\Livewire\Auth\ChangePassword::class);
        Livewire::component('platform.auth.forget-password', \QuickPanel\Platform\Livewire\Auth\ForgetPassword::class);
        Livewire::component('platform.auth.login', \QuickPanel\Platform\Livewire\Auth\Login::class);
        Livewire::component('platform.auth.logout', \QuickPanel\Platform\Livewire\Auth\Logout::class);
        Livewire::component('platform.auth.register', \QuickPanel\Platform\Livewire\Auth\Register::class);
        Livewire::component('platform.auth.verify-email', \QuickPanel\Platform\Livewire\Auth\VerifyEmail::class);
        Livewire::component('platform.front.faq.index', \QuickPanel\Platform\Livewire\Front\Faq\Index::class);
        Livewire::component('platform.front.home.index', \QuickPanel\Platform\Livewire\Front\Home\Index::class);
        Livewire::component('platform.user.dashboard.index', \QuickPanel\Platform\Livewire\User\Dashboard\Index::class);
        Livewire::component('platform.user.setting.password.index', \QuickPanel\Platform\Livewire\User\Setting\Password\Index::class);
        Livewire::component('platform.user.setting.profile.index', \QuickPanel\Platform\Livewire\User\Setting\Profile\Index::class);

        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\CreateAdminCommand::class,
                Console\Commands\CreatePermissionsCommand::class,
                Console\Commands\CreateRolesCommand::class,
                Console\Commands\QuickSetupCommand::class,
                Console\Commands\InstallCommand::class,
                Console\Commands\SetUserAdminCommand::class,
            ]);
        }

        // Migrations
        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'platform-migrations');

        // Publishes the config file
        $this->publishes([
            __DIR__.'/../config/platform.php' => config_path('platform.php'),
        ], 'platform-config');

        // Publishes the views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/platform'),
        ], 'platform-views');

        // Publishes the lang files
        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/platform'),
        ], 'platform-lang');
    }
}
