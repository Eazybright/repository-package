<?php

namespace Eazybright\RepositoryPackage;

class CreateRepositoryFiles
{
    public function createRepositoryServiceProviderFile()
    {
        //create repository service provider file. This file helps to bootstrap your repository interfaces
        $repositoryServiceProviderFileName = app_path('Providers/RepositoryServiceProvider.php');
        $repositoryServiceProviderFileContent = 
            <<<EOT
            <?php

            namespace App\Providers;
            
            use Illuminate\Support\ServiceProvider;

            class RepositoryServiceProvider extends ServiceProvider
            {
                public function register()
                {
                    //bind your interface here
                }
            }
            EOT;
        file_put_contents($repositoryServiceProviderFileName, $repositoryServiceProviderFileContent);
    }

    public function createRepositoryInterfaceFile($interfaceFileName, $modelName)
    {
        //add repository interface namespace to respositoryserviceprovider file
        $filename = app_path('Providers/RepositoryServiceProvider.php'); // the file to change
        $search = 'use Illuminate\Support\ServiceProvider;'; // the content after which you want to insert new stuff
        $insert = "use App\\Repositories\\Interfaces\\$modelName".'RepositoryInterface;'; // new namespace to be added
        $replace = $search. "\n". $insert;

        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename))); //replace the content here

        //create repository interface file into App\Repositories\Interfaces folder
        $interfaceFileContent = <<<EOT
                                <?php

                                namespace App\Repositories\Interfaces;

                                interface {$modelName}RepositoryInterface
                                {

                                }
                                EOT;

        file_put_contents($interfaceFileName, $interfaceFileContent);
    }

    public function createRepositoryFile($repositoryFileName, $modelName)
    {
        //create repository file into App\Repositories folder
        $repositoryFileContent =    
            <<<EOT
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