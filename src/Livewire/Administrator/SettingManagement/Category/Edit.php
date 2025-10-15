<?php

namespace QuickPanel\Platform\Livewire\Administrator\SettingManagement\Category;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use QuickPanel\Platform\Models\Setting\Category;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public int $categoryId;

    public string $title = '';
    public string $type = '';
    public ?string $icon = null;
    public ?string $image = null;
    public string $language = 'en';
    public ?string $description = null;
    public int $sort_order = 1;

    public function mount(int $categoryId): void
    {
        $this->categoryId = $categoryId;
        $category = Category::findOrFail($categoryId);

        $this->title = (string) $category->title;
        $this->type = (string) $category->type;
        $this->icon = $category->icon;
        $this->image = $category->image;
        $this->language = (string) $category->language;
        $this->description = $category->description;
        $this->sort_order = (int) $category->sort_order;
    }

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

    public function update(): void
    {
        $data = $this->validate();

        $category = Category::findOrFail($this->categoryId);
        $category->update($data);

        Toaster::success(__("platform::common.updated"));

        $this->dispatch('modal-close');
        $this->dispatch('pg:eventRefresh-administrator.setting-management.category.table');
    }

    public function render()
    {
        return view('platform::livewire.administrator.setting-management.category.edit');
    }
}
