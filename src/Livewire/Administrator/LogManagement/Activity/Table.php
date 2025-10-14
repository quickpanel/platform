<?php

namespace QuickPanel\Platform\Livewire\Administrator\LogManagement\Activity;

use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Spatie\Activitylog\Models\Activity;

final class Table extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'administrator.log-management.activity.table';

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
        return Activity::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('attributes')
            ->add('old')
            ->add('created_at_formatted', fn (Activity $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('platform::common.id'), 'id'),
            Column::make(__('platform::common.attributes'), 'attributes')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.old'), 'old')
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




    public function actionsFromView(Activity $row): View
    {
        return view('platform::livewire.administrator.log-management.activity.index', ['activity' => $row]);
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
