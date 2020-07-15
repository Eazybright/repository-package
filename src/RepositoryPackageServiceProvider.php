<?php

namespace Eazybright\RepositoryPackage;

use Illuminate\Support\ServiceProvider;
use Eazybright\RepositoryPackage\Console\InstallRepositoryPackage;

class RepositoryPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'repositorypackage'); 
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // publish config file
        
            $this->commands([
                InstallRepositoryPackage::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('repositorypackage.php'),
              ], 'config');
        }
    }
}