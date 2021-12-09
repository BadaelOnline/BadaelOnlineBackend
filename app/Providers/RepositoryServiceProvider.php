<?php

namespace App\Providers;

use App\Repositories\BannerRepository;
use App\Repositories\FrontRepository;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\Interfaces\FrontRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\TeamRepository;
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
        $this->app->bind(FrontRepositoryInterface::class,FrontRepository::class);
        $this->app->bind(TeamRepositoryInterface::class,TeamRepository::class);
        // $this->app->bind(BannerRepositoryInterface::class,BannerRepository::class);
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