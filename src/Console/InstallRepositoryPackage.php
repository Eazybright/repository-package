<?php

namespace Eazybright\RepositoryPackage\Console;

use Illuminate\Console\Command;

class InstallRepositoryPackage extends Command
{
    protected $signature = 'repository:create {ModelName}';

    protected $description = 'Install the RepositoryPackage';

    public function handle()
    {
        $modelName = $this->argument('ModelName');

        if ($modelName === '' || is_null($modelName) || empty($modelName)) {
            $this->error('Invalid argument name. Please provide a valid argument name');
        }
        
        if (!file_exists(app_path('Repositories')) && !file_exists(app_path('Repositories/Interfaces'))) {

            mkdir(app_path('Repositories'), 0775, true);
            mkdir(app_path('Repositories/Interfaces'), 0775, true);
        }

        if (!file_exists(app_path('Providers'))) {
            mkdir(app_path('Providers'), 0775, true);
            $repositoryServiceProviderFileName = app_path('Providers/RepositoryServiceProvider.php');
            $this->createRepositoryServiceProviderFile($repositoryServiceProviderFileName);
        }else{
            $repositoryServiceProviderFileName = app_path('Providers/RepositoryServiceProvider.php');
            $this->createRepositoryServiceProviderFile($repositoryServiceProviderFileName);
        }

        $repositoryFileName = app_path('Repositories/') . $modelName . 'Repository.php';
        $interfaceFileName = app_path('Repositories/Interfaces/'). $modelName . 'RepositoryInterface.php';

        if(! file_exists($repositoryFileName) && ! file_exists($interfaceFileName)) {

            $this->createRepositoryInterfaceFile($interfaceFileName, $modelName);

            $this->createRepositoryFile($repositoryFileContent, $modelName);

            $this->info('Created new Repository '.$modelName.'Repository.php in App\Repositories.');

        } else {
            $this->error('Repository Files Already Exists.');
        }
    }

    protected function createRepositoryServiceProviderFile($repositoryServiceProviderFileName)
    {
        $repositoryServiceProviderFileContent = <<<EOT
                    <?php

                    namespace App\Providers;
                    
                    use Illuminate\Support\ServiceProvider;

                    class RepositoryServiceProvider extends ServiceProvider
                    {
                        public function boot()
                        {
                            
                        }
                    }
                EOT;
        file_put_contents($repositoryServiceProviderFileName, $repositoryServiceProviderFileContent);
    }

    protected function createRepositoryInterfaceFile($interfaceFileName, $modelName)
    {
        $interfaceFileContent = <<<EOT
                                <?php

                                namespace App\Repositories\Interfaces;

                                interface {$modelName}RepositoryInterface
                                {

                                }
                                EOT;

        file_put_contents($interfaceFileName, $interfaceFileContent);
    }

    protected function createRepositoryFile($repositoryFileContent, $modelName)
    {
        $repositoryFileContent = <<<EOT
                <?php

                namespace App\Repositories;

                use App\\Repositories\\Interfaces\\{$modelName}RepositoryInterface;

                class {$modelName}Repository implements {$modelName}RepositoryInterface
                {

                }
            EOT;

        file_put_contents($repositoryFileName, $repositoryFileContent);
    }
}