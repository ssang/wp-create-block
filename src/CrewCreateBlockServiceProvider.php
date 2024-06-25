<?php

namespace Crew\CreateBlock;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CrewCreateBlockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([Console\Commands\CreateBlockCommand::class]);
        }
    }
}
