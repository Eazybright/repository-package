<?php

namespace Eazybright\RepositoryPackage;

class CreateRepositoryFiles
{
    public function createRepositoryServiceProviderFile()
    {
        $repositoryServiceProviderFileName = app_path('Providers/RepositoryServiceProvider.php');
        $repositoryServiceProviderFileContent = 
            <<<EOT
            <?php

            namespace App\Providers;
            
            use Illuminate\Support\ServiceProvider;

            class RepositoryServiceProvider extends ServiceProvider
            {
                public function boot()
                {
                    //bind your interface here
                }
            }
            EOT;
        file_put_contents($repositoryServiceProviderFileName, $repositoryServiceProviderFileContent);
    }

    public function createRepositoryInterfaceFile($interfaceFileName, $modelName)
    {
        $filename = app_path('Providers/RepositoryServiceProvider.php'); // the file to change
        $search = 'use Illuminate\Support\ServiceProvider;'; // the content after which you want to insert new stuff
        $insert = "use App\\Repositories\\Interfaces\\$modelName".'RepositoryInterface'; // your new stuff
        // $replace =  "use Illuminate\Support\ServiceProvider;"
                    
                    // use App\\Repositories\\Interfaces\\{$modelName}RepositoryInterface;
                    // EOT;
        $replace = $search. "\n". $insert;

        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));

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