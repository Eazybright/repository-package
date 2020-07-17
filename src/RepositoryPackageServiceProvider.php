<?php

namespace Eazybright\RepositoryPackage;

use Illuminate\Support\ServiceProvider;
use Eazybright\RepositoryPackage\Console\InstallRepositoryPackage;

class RepositoryPackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap RepositoryPackageServiceProvider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                InstallRepositoryPackage::class
            ]);
        }
    }
}