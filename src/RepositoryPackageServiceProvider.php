<?php

namespace Eazybright\RepositoryPackage;

use Illuminate\Support\ServiceProvider;
use Eazybright\RepositoryPackage\Console\InstallRepositoryPackage;
// use Eazybright\RepositoryPackage\CreateRepositoryFiles;

class RepositoryPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                InstallRepositoryPackage::class
            ]);
        }
    }
}