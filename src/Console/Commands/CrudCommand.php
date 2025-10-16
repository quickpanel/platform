<?php

namespace QuickPanel\Platform\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:crud {namespace} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD components and views based on stubs';

    protected $namespace;
    protected $model;
    protected $modelLower;
    protected $modelPlural;
    protected $modelPluralLower;
    protected $componentPath;
    protected $viewPath;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        App::setLocale('en');
        
        $this->namespace = $this->argument('namespace');
        $this->model = $this->argument('model');
        $this->modelLower = Str::lower($this->model);
        $this->modelPlural = Str::plural($this->model);
        $this->modelPluralLower = Str::lower($this->modelPlural);
        
        $this->info("Generating CRUD for {$this->namespace}\\{$this->model}");
        
        // Set up paths
        $this->setupPaths();
        
        // Generate components
        $this->generateComponents();
        
        // Generate views
        $this->generateViews();
        
        $this->info('CRUD generation completed successfully!');
    }

    protected function setupPaths()
    {
        $namespacePath = str_replace('\\', '/', $this->namespace);
        $this->componentPath = app_path("Livewire/{$namespacePath}/{$this->model}");
        
        // Convert namespace to kebab-case properly
        $namespaceParts = explode('\\', $this->namespace);
        $kebabParts = array_map(function($part) {
            return Str::kebab($part);
        }, $namespaceParts);
        $namespaceKebab = implode('/', $kebabParts);
        
        $this->viewPath = resource_path("views/livewire/" . $namespaceKebab . '/' . Str::kebab($this->model));
    }

    protected function generateComponents()
    {
        // Create component directory
        if (!File::exists($this->componentPath)) {
            File::makeDirectory($this->componentPath, 0755, true);
        }

        // Generate Create component
        $this->generateCreateComponent();
        
        // Generate Edit component
        $this->generateEditComponent();
        
        // Generate Index component
        $this->generateIndexComponent();
        
        // Generate Table component
        $this->generateTableComponent();
    }

    protected function generateCreateComponent()
    {
        $stub = File::get(__DIR__ . '/../../stubs/components/Create.stub');
        $content = $this->replacePlaceholders($stub);
        File::put($this->componentPath . '/Create.php', $content);
        $this->info("Created: {$this->componentPath}/Create.php");
    }

    protected function generateEditComponent()
    {
        $stub = File::get(__DIR__ . '/../../stubs/components/Edit.stub');
        $content = $this->replacePlaceholders($stub);
        File::put($this->componentPath . '/Edit.php', $content);
        $this->info("Created: {$this->componentPath}/Edit.php");
    }

    protected function generateIndexComponent()
    {
        $stub = File::get(__DIR__ . '/../../stubs/components/Index.stub');
        $content = $this->replacePlaceholders($stub);
        File::put($this->componentPath . '/Index.php', $content);
        $this->info("Created: {$this->componentPath}/Index.php");
    }

    protected function generateTableComponent()
    {
        $stub = File::get(__DIR__ . '/../../stubs/components/Table.stub');
        $content = $this->replacePlaceholders($stub);
        File::put($this->componentPath . '/Table.php', $content);
        $this->info("Created: {$this->componentPath}/Table.php");
    }

    protected function generateViews()
    {
        // Create view directory
        if (!File::exists($this->viewPath)) {
            File::makeDirectory($this->viewPath, 0755, true);
        }

        // Generate create view
        $this->generateCreateView();
        
        // Generate edit view
        $this->generateEditView();
        
        // Generate index view
        $this->generateIndexView();
        
        // Generate actions view
        $this->generateActionsView();
    }

    protected function generateCreateView()
    {
        $stub = File::get(__DIR__ . '/../../stubs/view/livewire/create.blade.php');
        $content = $this->replacePlaceholders($stub);
        File::put($this->viewPath . '/create.blade.php', $content);
        $this->info("Created: {$this->viewPath}/create.blade.php");
    }

    protected function generateEditView()
    {
        $stub = File::get(__DIR__ . '/../../stubs/view/livewire/edit.blade.php');
        $content = $this->replacePlaceholders($stub);
        File::put($this->viewPath . '/edit.blade.php', $content);
        $this->info("Created: {$this->viewPath}/edit.blade.php");
    }

    protected function generateIndexView()
    {
        $stub = File::get(__DIR__ . '/../../stubs/view/livewire/index.blade.php');
        $content = $this->replacePlaceholders($stub);
        File::put($this->viewPath . '/index.blade.php', $content);
        $this->info("Created: {$this->viewPath}/index.blade.php");
    }

    protected function generateActionsView()
    {
        $stub = File::get(__DIR__ . '/../../stubs/view/livewire/actions.blade.php');
        $content = $this->replacePlaceholders($stub);
        File::put($this->viewPath . '/actions.blade.php', $content);
        $this->info("Created: {$this->viewPath}/actions.blade.php");
    }

    protected function replacePlaceholders($content)
    {
        $namespacePath = strtolower(str_replace('\\', '/', $this->namespace));
        
        // Convert namespace to kebab-case properly for view path
        $namespaceParts = explode('\\', $this->namespace);
        $kebabParts = array_map(function($part) {
            return Str::kebab($part);
        }, $namespaceParts);
        $viewPath = 'livewire.' . implode('.', $kebabParts) . '.' . Str::kebab($this->model);
        
        $modelNamespace = "App\\Models\\{$this->model}";
        $tableName = implode('.', $kebabParts) . ".{$this->model}.table";
        
        $replacements = [
            '{{namespace}}' => $this->namespace,
            '{{model}}' => $this->model,
            '{{modelLower}}' => $this->modelLower,
            '{{modelPlural}}' => $this->modelPlural,
            '{{modelPluralLower}}' => $this->modelPluralLower,
            '{{componentNamespace}}' => "App\\Livewire\\{$this->namespace}\\{$this->model}",
            '{{viewPath}}' => $viewPath,
            '{{tableName}}' => $tableName,
            '{{modalComponent}}' => "platform.{$namespacePath}.{$this->modelPluralLower}",
            '{{routeName}}' => strtolower(str_replace('\\', '.', $this->namespace)) . ".{$this->modelPluralLower}.index",
            '{{modelVariable}}' => $this->modelLower,
            '{{modelId}}' => $this->modelLower . 'Id',
            '{{modelVariablePlural}}' => $this->modelPluralLower,
            '{{namespacePath}}' => $namespacePath,
            '{{modelNamespace}}' => $modelNamespace,
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $content);
    }
}
