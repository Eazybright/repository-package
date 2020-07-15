<?php

namespace Eazybright\RepositoryPackage;

use Illuminate\Support\ServiceProvider;
use Eazybright\RepositoryPackage\Console\InstallRepositoryPackage;

class RepositoryPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // publish config file
        
            $this->commands([
                InstallRepositoryPackage::class,
            ]);
        }
    }
}