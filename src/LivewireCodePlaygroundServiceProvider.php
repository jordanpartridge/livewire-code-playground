<?php

namespace JordanPartridge\LivewireCodePlayground;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireCodePlaygroundServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-code-playground');
        
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/livewire-code-playground'),
        ], 'livewire-code-playground-views');

        $this->publishes([
            __DIR__ . '/../config/code-playground.php' => config_path('code-playground.php'),
        ], 'livewire-code-playground-config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/livewire-code-playground'),
        ], 'livewire-code-playground-assets');

        Livewire::component('code-playground', CodePlayground::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/code-playground.php',
            'code-playground'
        );
    }
}