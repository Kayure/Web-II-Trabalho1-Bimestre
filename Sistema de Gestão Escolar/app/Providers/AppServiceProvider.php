<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider {

    public function register() {
        
    }

    public function boot() {

        Blade::component('components.datalist', 'datalist');
    }
}
