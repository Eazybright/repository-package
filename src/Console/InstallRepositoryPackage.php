<?php

namespace Eazybright\RepositoryPackage\Console;

use Illuminate\Console\Command;
use Eazybright\RepositoryPackage\CreateRepositoryFiles;

class InstallRepositoryPackage extends Command
{
    protected $signature = 'repository:create {ModelName}';

    protected $description = 'Install the Repository Package';

    public $createFile;

    public function __construct(CreateRepositoryFiles $createFile)
    {
        parent::__construct();

        $this->createFile = $createFile;
    }

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
            $this->createFile->createRepositoryServiceProviderFile();
        }elseif(!file_exists(app_path('Providers/RepositoryServiceProvider.php'))){
            $this->createFile->createRepositoryServiceProviderFile();
        }

        $repositoryFileName = app_path('Repositories/') . $modelName . 'Repository.php';
        $interfaceFileName = app_path('Repositories/Interfaces/'). $modelName . 'RepositoryInterface.php';

        if(! file_exists($repositoryFileName) && ! file_exists($interfaceFileName)) {

            $this->createFile->createRepositoryInterfaceFile($interfaceFileName, $modelName);

            $this->createFile->createRepositoryFile($repositoryFileName, $modelName);

            $this->info('Created new Repository successfully in App\Repositories directory');

        } else {
            $this->error('Repository Files Already Exists.');
        }
    }
}