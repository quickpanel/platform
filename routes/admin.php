<?php

use Illuminate\Support\Facades\Route;

if (config('platform.enable_admin')) {
    Route::middleware('web')->group(function () {
        Route::middleware(\QuickPanel\Platform\Http\Middleware\RedirectIfAuthenticatedAdminMiddleware::class)->group(function () {
            Route::get('/administrator/auth/login', QuickPanel\Platform\Livewire\Administrator\Auth\Login::class)->name('administrator.auth.login');
            Route::get('/administrator/auth/forget-password', QuickPanel\Platform\Livewire\Administrator\Auth\ForgetPassword::class)->name('administrator.auth.forget-password');
        });

        Route::middleware('auth:admin')->group(function () {
            Route::get('/administrator/auth/logout', QuickPanel\Platform\Livewire\Administrator\Auth\Logout::class)->name('administrator.auth.logout');
            Route::get('/administrator/auth/change-password', QuickPanel\Platform\Livewire\Administrator\Auth\ChangePassword::class)->name('administrator.auth.change-password');
        });

        Route::middleware(['auth:admin', \QuickPanel\Platform\Http\Middleware\AdministratorAccessMiddleware::class])->group(function () {
            Route::get('/administrator/dashboard/index', QuickPanel\Platform\Livewire\Administrator\Dashboard\Index::class)->name('administrator.dashboard.index');
            Route::get('/administrator/user-management/admin/index', QuickPanel\Platform\Livewire\Administrator\UserManagement\Admin\Index::class)->name('administrator.user-management.admin.index');
            Route::get('/administrator/user-management/user/index', QuickPanel\Platform\Livewire\Administrator\UserManagement\User\Index::class)->name('administrator.user-management.user.index');
            Route::get('/administrator/user-management/role/index', QuickPanel\Platform\Livewire\Administrator\UserManagement\Role\Index::class)->name('administrator.user-management.role.index');
            Route::get('/administrator/user-management/permission/index', QuickPanel\Platform\Livewire\Administrator\UserManagement\Permission\Index::class)->name('administrator.user-management.permission.index');

            Route::get('/administrator/log-management/activity/index', QuickPanel\Platform\Livewire\Administrator\LogManagement\Activity\Index::class)->name('administrator.log-management.activity.index');
            Route::get('/administrator/log-management/auth/index', QuickPanel\Platform\Livewire\Administrator\LogManagement\Auth\Index::class)->name('administrator.log-management.auth.index');

            Route::get('/administrator/support-management/ticket/index', QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket\Index::class)->name('administrator.support-management.ticket.index');
            Route::get('/administrator/support-management/ticket/unread', QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket\Unread::class)->name('administrator.support-management.ticket.unread');
            Route::get('/administrator/support-management/ticket/view/{ticketId}', QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket\View::class)->name('administrator.support-management.ticket.view');

            Route::get('/administrator/setting-management/option/index', QuickPanel\Platform\Livewire\Administrator\SettingManagement\Option\Index::class)->name('administrator.setting-management.option.index');
            Route::get('/administrator/setting-management/function/index', QuickPanel\Platform\Livewire\Administrator\SettingManagement\Function\Index::class)->name('administrator.setting-management.function.index');
            Route::get('/administrator/setting-management/category/index', QuickPanel\Platform\Livewire\Administrator\SettingManagement\Category\Index::class)->name('administrator.setting-management.category.index');
        });
    });
}
