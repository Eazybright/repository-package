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

        $repositoryFileName = app_path('Repositories/') . $modelName . 'Repository.php';
        $interfaceFileName = app_path('Repositories/Interfaces/'). $modelName . 'RepositoryInterface.php';

        if(! file_exists($repositoryFileName) && ! file_exists($interfaceFileName)) {
            $interfaceFileContent = <<<EOT
                                    <?php

                                    namespace App\Repositories\Interfaces;

                                    interface {$modelName}RepositoryInterface
                                    {

                                    }
                                    EOT;

            file_put_contents($interfaceFileName, $interfaceFileContent);

            $repositoryFileContent = <<<EOT
                        <?php

                        namespace App\Repositories;

                        use App\\Repositories\\Interfaces\\{$modelName}RepositoryInterface;

                        class {$modelName}Repository implements {$modelName}RepositoryInterface
                        {

                        }
                        EOT;

            file_put_contents($repositoryFileName, $repositoryFileContent);

            $this->info('Created new Repository '.$modelName.'Repository.php in App\Repositories.');

        } else {
            $this->error('Repository Files Already Exists.');
        }
    }
}