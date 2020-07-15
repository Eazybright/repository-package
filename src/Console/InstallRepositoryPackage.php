<?php

namespace Eazybright\RepositoryPackage\Console;

use Illuminate\Console\Command;

class InstallRepositoryPackage extends Command
{
    protected $signature = 'repositorypackage:create';

    protected $description = 'Install the RepositoryPackage';

    public function handle()
    {
        $this->info('Installing RepositoryPackage...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Eazybright\RepositoryPackage\RepositoryPackageServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed RepositoryPackage');
    }
}