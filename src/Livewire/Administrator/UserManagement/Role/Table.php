<?php

namespace QuickPanel\Platform\Livewire\Administrator\UserManagement\Role;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\View\View;

final class Table extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'administrator.user-management.role.index';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable(fileName: $this->tableName."-".date("Y-m-d-H-i-s"))
                ->striped()
                ->type(\PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('create-role')
                ->can(auth()->user()->can('administrator_user_role_create'))
                ->slot(__('platform::common.create_role'))
                ->class('text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800')
                ->dispatch('modal-open', ['component' => 'platform.administrator.user-management.role.create']),
        ];
    }

    public function datasource(): \Illuminate\Database\Eloquent\Builder
    {
        return Role::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('guard_name')
            ->add('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('platform::common.id'), 'id'),
            Column::make(__('platform::common.name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('platform::common.guard_name'), 'guard_name')
                ->sortable()
                ->searchable(),

            Column::make(__('platform::common.created_at'), 'created_at_formatted', 'created_at')
                ->sortable(),
            Column::action(__('platform::common.action'))

        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($id): void
    {
        if ($role = Role::findById($id)) {
            $role->delete();
            \Masmerise\Toaster\Toaster::success(__('platform::common.role_deleted'));
        }
        $this->dispatch('pg:eventRefresh-administrator.user-management.role.index');
    }

    public function actionsFromView(\Spatie\Permission\Models\Role $row): View
    {
        return view('platform::livewire.administrator.user-management.role.actions', ['role' => $row]);
    }
}
