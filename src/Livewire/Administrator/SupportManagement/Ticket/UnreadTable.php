<?php

namespace QuickPanel\Platform\Livewire\Administrator\SupportManagement\Ticket;

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
use QuickPanel\Platform\Models\Support\Ticket;

final class Table extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'administrator.support-management.ticket.unread-table';

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
        return Ticket::query()->with('user');
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
            ->add('status')
            ->add('email', fn (Ticket $model) => $model->user->email)
            ->add('created_at_formatted', fn (Ticket $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make(__('platform::common.id'), 'id')
                ->sortable(),
            Column::make(__('platform::common.title'), 'title')
                ->sortable()
                ->searchable(),

            Column::make(__('platform::common.status'), 'status')
                ->sortable()
                ->searchable(),

            Column::make(__('platform::common.email'), 'email')
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

    #[On('administrator.support-management.ticket.unread-table:delete-ticket')]
    public function deleteTicket(int $ticektId): void
    {
        if ($record = Ticket::find($ticektId)) {
            $record->delete();
            Toaster::success( __('platform::common.deleted'));
        }

        // Refresh table after delete
        $this->dispatch('pg:eventRefresh-administrator.support-management.ticket.unread-table');
    }


    public function actionsFromView(Ticket $row): View
    {
        return view('platform::livewire.administrator.support-management.ticket.actions', ['ticket' => $row]);
    }

}
