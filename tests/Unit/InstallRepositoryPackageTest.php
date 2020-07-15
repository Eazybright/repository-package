<?php

namespace Eazybright\RepositoryPackage\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Eazybright\RepositoryPackage\Tests\TestCase;

class InstallRepositoryPackageTest extends TestCase
{
     /** @test */
    public function the_install_command_copies_a_the_configuration()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('repositorypackage.php'))) {
            unlink(config_path('repositorypackage.php'));
        }

        $this->assertFalse(File::exists(config_path('repositorypackage.php')));

        Artisan::call('repositorypackage:create');

        $this->assertTrue(File::exists(config_path('repositorypackage.php')));
    }
}