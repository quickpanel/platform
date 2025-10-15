<?php

namespace QuickPanel\Platform\Livewire\Administrator\SettingManagement\Category;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use QuickPanel\Platform\Models\Setting\Category;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public string $title = '';
    public string $type = '';
    public ?string $icon = null;
    public ?string $image = null;
    public string $language = 'en';
    public ?string $description = null;
    public int $sort_order = 1;

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(config('platform.types', [])))],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'language' => ['required', 'string', 'max:5', Rule::in(array_keys(config('platform.languages', [])))],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ];
    }

    public function create(): void
    {
        $data = $this->validate();

        Category::create($data);

        Toaster::success(__("platform::common.created"));

        $this->dispatch('modal-close');
        $this->dispatch('pg:eventRefresh-administrator.setting-management.category.table');

        $this->reset();
        $this->language = 'en';
        $this->sort_order = 1;
    }

    public function render()
    {
        return view('platform::livewire.administrator.setting-management.category.create');
    }
}
