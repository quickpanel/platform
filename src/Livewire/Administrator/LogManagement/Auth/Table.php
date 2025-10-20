<?php

namespace QuickPanel\Platform\Livewire\Administrator\LogManagement\Auth;

use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
use Spatie\Activitylog\Models\Activity;

final class Table extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'administrator.log-management.auth.table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return AuthenticationLog::query()
            ->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('ip_address')
            ->add('user_agent')
            ->add('login_at')
            ->add('logout_at')
            ->add('login_successful')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make(__('platform::common.id'), 'id')
                ->sortable(),
            Column::make(__('platform::common.ip_address'), 'ip_address')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.user_agent'), 'user_agent')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.login_at'), 'login_at')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.logout_at'), 'logout_at')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.login_successful'), 'login_successful')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.created_at'), 'created_at')
                ->sortable(),
            Column::action(__('platform::common.action'))
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('ip_address'),
            Filter::inputText('user_agent'),
            Filter::datetimepicker('created_at'),
        ];
    }




    public function actionsFromView(AuthenticationLog $row): View
    {
        return view('platform::livewire.administrator.log-management.auth.actions', ['AuthenticationLog' => $row]);
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
