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
        return Activity::query()
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
            ->add('subject_type')
            ->add('event')
            ->add('causer_type')
            ->add('causer_id')
            ->add('causer_id')
            ->add('created_at_formatted', fn (Activity $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('platform::common.id'), 'id')
                ->sortable(),
            Column::make(__('platform::common.subject_type'), 'subject_type')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.event'), 'event')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.causer_type'), 'causer_type')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.causer_id'), 'causer_id')
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
            Filter::inputText('subject_type'),
            Filter::inputText('event'),
            Filter::inputText('causer_type'),
            Filter::datetimepicker('created_at'),
        ];
    }




    public function actionsFromView(Activity $row): View
    {
        return view('platform::livewire.administrator.log-management.activity.actions', ['activity' => $row]);
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
