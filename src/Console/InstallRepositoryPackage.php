<?php

namespace Eazybright\RepositoryPackage\Console;

use Illuminate\Console\Command;
use Eazybright\RepositoryPackage\CreateRepositoryFiles;

class InstallRepositoryPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repository:create {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Repository Package';

    public $createFile;

     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CreateRepositoryFiles $createFile)
    {
        parent::__construct();

        $this->createFile = $createFile;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
 
    public function handle()
    {
        $modelName = $this->argument('ModelName');

        //return error if an argument name is not provided
        if ($modelName === '' || is_null($modelName) || empty($modelName)) {
            $this->error('Invalid argument name. Please provide a valid argument name');
        }
        
        //create Repostiories and Repostiories/Interfaces folder
        if (!file_exists(app_path('Repositories')) && !file_exists(app_path('Repositories/Interfaces'))) {
            mkdir(app_path('Repositories'), 0775, true);
            mkdir(app_path('Repositories/Interfaces'), 0775, true);
        }

        //create Providers folder and/ Providers/RepositoryServiceProvider file 
        if (!file_exists(app_path('Providers'))) {
            mkdir(app_path('Providers'), 0775, true);
            $this->createFile->createRepositoryServiceProviderFile();
        }elseif(!file_exists(app_path('Providers/RepositoryServiceProvider.php'))){
            $this->createFile->createRepositoryServiceProviderFile();
        }

        $repositoryFileName = app_path('Repositories/') . $modelName . 'Repository.php';
        $interfaceFileName = app_path('Repositories/Interfaces/'). $modelName . 'RepositoryInterface.php';

        //create the repository files and interfaces in App\Repostories and App\Repostories\Interfaces folders
        if(! file_exists($repositoryFileName) && ! file_exists($interfaceFileName)) {

            $this->createFile->createRepositoryInterfaceFile($interfaceFileName, $modelName);

            $this->createFile->createRepositoryFile($repositoryFileName, $modelName);

            $this->info('Created new Repository successfully in App\Repositories directory');

        } else {
            $this->error('Repository Files Already Exists.');
        }
    }
}