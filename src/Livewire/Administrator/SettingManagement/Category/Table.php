<?php

namespace QuickPanel\Platform\Livewire\Administrator\SettingManagement\Category;

use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use QuickPanel\Platform\Models\Setting\Category;

final class Table extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'administrator.setting-management.category.table';

    public function header(): array
    {
        return [
            Button::add('create-category')
                ->slot(__('platform::common.create_category'))
                ->class('text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800')
                ->dispatch('modal-open', ['component' => 'platform.administrator.setting-management.category.create']),
        ];
    }
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
        return Category::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('type')
            ->add('icon')
            ->add('image')
            ->add('language')
            ->add('description')
            ->add('sort_order')
            ->add('created_at_formatted', fn (Category $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('platform::common.id'), 'id')
                ->sortable(),
            Column::make(__('platform::common.title'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.type'), 'type')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.icon'), 'icon')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.image'), 'image')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.language'), 'language')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.description'), 'description')
                ->sortable()
                ->searchable(),
            Column::make(__('platform::common.sort_order'), 'sort_order')
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

    #[On('administrator.setting-management.category.table:delete-category')]
    public function deleteCategory(int $categoryId): void
    {
        if ($record = Category::find($categoryId)) {
            $record->delete();
            Toaster::success(__('platform::common.deleted'));
        }

        // Refresh table after delete
        $this->dispatch('pg:eventRefresh-administrator.setting-management.category.table');
    }

    public function actionsFromView(Category $row): View
    {
        return view('platform::livewire.administrator.setting-management.category.actions', ['category' => $row]);
    }

}
