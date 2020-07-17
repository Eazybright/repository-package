# Repository Package
![hero](https://miro.medium.com/max/1512/0*7JRxmo6yK_DLdoZl.png) 

##### Photo Credit: [Repository design pattern done right in Laravel | by Daan | ITNEXT](https://itnext.io/repository-design-pattern-done-right-in-laravel-d177b5fa75d4)

## Introduction

This package main purpose is to manage repository design pattern in your laravel projects. It helps you create your repository and interface files respectively with a single command.

## Installation

To install this package run:

```bash
composer require eazybright/repository-package
```
This will install the package into your project.

## Usage
Next, create a repostory file by running:
```bash
php artisan repository:create Blog
```

Make sure to provide your own argument name when running the above command, I used *Blog* as an example.

Once the command run, it creates the repository files `App\Repositories\BlogRepository.php`, `App\Repositories\Interfaces\BlogRepositoryInterface.php` and also create a service provider file in `App\Providers\RepositoryServiceProvider.php`.

You need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

```php
'providers' => [
    ...
    App\Providers\RepositoryServiceProvider::class,
    ...
]
```

You need to register the Repository file into `RepositoryServiceProvider::class` whenever it is created.
The `App\Repositories\Interfaces\BlogRepositoryInterface` namespace has been imported already.

```php
<?php
...
    public function register()
    {
        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        )
    }
...
```

## Contributing

Please feel free to star and fork this package. You can also contribute by submitting a pull request to enhance the functionalities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.