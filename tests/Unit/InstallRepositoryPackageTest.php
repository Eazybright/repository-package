<?php

namespace Eazybright\RepositoryPackage\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Eazybright\RepositoryPackage\Tests\TestCase;

class InstallRepositoryPackageTest extends TestCase
{
    /** @test */
    public function the_repository_files_are_created()
    {
        $this->withoutExceptionHandling();
        Artisan::call('repository:create', ['ModelName' => 'Post']);

        $this->assertTrue(File::exists(app_path('Repositories/PostRepository.php')));
        $this->assertTrue(File::exists(app_path('Repositories/Interfaces/PostRepositoryInterface.php')));
        $this->assertTrue(File::exists(app_path('Providers/RepositoryServiceProvider.php')));
    }
}