<?php

namespace Eazybright\RepositoryPackage\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Eazybright\RepositoryPackage\Tests\TestCase;

class InstallRepositoryPackageTest extends TestCase
{
     /** @test */
    // public function the_install_command_copies_a_the_configuration()
    // {
    //     // make sure we're starting from a clean state
    //     if (File::exists(config_path('repositorypackage.php'))) {
    //         unlink(config_path('repositorypackage.php'));
    //     }

    //     $this->assertFalse(File::exists(config_path('repositorypackage.php')));

    //     Artisan::call('repositorypackage:create');

    //     $this->assertTrue(File::exists(config_path('repositorypackage.php')));
    // }

    /** @test */
    public function the_repository_files_are_created()
    {
        // if (File::exists(app_path('Repositories')) && File::exists(app_path('Repositories/Interfaces'))) {
        //     rmdir(app_path('Repositories'));
        //     rmdir(app_path('Repositories/Interfaces'));
        // }

        // $this->assertFalse(File::exists(app_path('Repositories')));
        // $this->assertFalse(File::exists(app_path('Repositories/Interfaces')));

        Artisan::call('repository:create', ['ModelName' => 'Sule']);

        $this->assertTrue(File::exists(app_path('Repositories/SuleRepository.php')));
        $this->assertTrue(File::exists(app_path('Repositories/Interfaces/SuleRepositoryInterface.php')));
    }
}