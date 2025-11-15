<?php

namespace Kks\LogEnhancer;

use Illuminate\Support\ServiceProvider;

class LogEnhancerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Nothing to boot because the helper file overrides info()
    }

    public function register()
    {
        // No bindings needed
    }
}