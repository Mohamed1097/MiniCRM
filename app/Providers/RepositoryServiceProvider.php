<?php

namespace App\Providers;

use App\Interfaces\CompanyRepoInterface;
use App\Interfaces\ContactRepoInterface;
use App\Interfaces\EloquentRepoInterface;
use App\Interfaces\UserRepoInterface;
use App\Repos\BaseRepo;
use App\Repos\CompanyRepo;
use App\Repos\ContactRepo;
use App\Repos\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepoInterface::class,BaseRepo::class);
        $this->app->bind(UserRepoInterface::class,UserRepo::class);
        $this->app->bind(CompanyRepoInterface::class,CompanyRepo::class);
        $this->app->bind(ContactRepoInterface::class,ContactRepo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
