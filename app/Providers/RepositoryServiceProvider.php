<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\RepositoryInterface;
use App\Repository\RepositoryAbstract;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, RepositoryAbstract::class);
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
