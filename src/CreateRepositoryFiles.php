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
        $search_service_provider = 'use Illuminate\Support\ServiceProvider;'; // the content after which you want to insert new stuff
        $interface_namespace = "use App\\Repositories\\Interfaces\\$modelName".'RepositoryInterface;'; // new namespace to be added
        $repository_namespace = "use App\\Repositories\\$modelName".'Repository;';
        $replace = $search_service_provider. "\n". $interface_namespace. "\n". $repository_namespace;

        file_put_contents($filename, str_replace($search_service_provider, $replace, file_get_contents($filename))); //replace the content here


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

    public function registerRepositoryClass($modelName)
    {
      $filename = app_path('Providers/RepositoryServiceProvider.php'); // the file to change
      $interface_name = $modelName.'RepositoryInterface';
      $repository_name = $modelName.'Repository';
      $search = '//bind your interface here';
      $repository_binding = '       $this->app->bind('.$interface_name.'::class, '.$repository_name.'::class);';
      $replace = $search."\n".$repository_binding;

      file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));
    }
}