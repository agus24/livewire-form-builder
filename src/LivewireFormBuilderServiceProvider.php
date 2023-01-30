<?php
namespace Gustiawan\LivewireFormBuilder;

use Livewire\Livewire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Gustiawan\LivewireFormBuilder\livewire\FormBuilderComponent;

class LivewireFormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FormBuilder', fn() => new FormBuilder);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('form-builder', FormBuilderComponent::class);
        $this->loadViewsFrom(__DIR__.'/views/livewire', 'livewire-form-builder');
    }
}
