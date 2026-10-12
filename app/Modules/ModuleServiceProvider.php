<?php

namespace App\Modules;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use ReflectionClass;

abstract class ModuleServiceProvider extends ServiceProvider
{
    abstract protected function moduleAlias(): string;

    public function boot(): void
    {
        $path = $this->modulePath();
        $this->loadViewsFrom($path.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views', $this->moduleAlias());
        Livewire::addNamespace(
            namespace: $this->moduleAlias(),
            viewPath: $path.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'livewire',
        );
        foreach (glob($path.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'*.php') ?: [] as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
    }

    protected function modulePath(): string
    {
        return dirname((string) (new ReflectionClass($this))->getFileName());
    }
}
