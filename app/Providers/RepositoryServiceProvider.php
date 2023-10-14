<?php

namespace App\Providers;


use App\Interfaces\Repositories\BannerRepositoryInterface;
use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\App;
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
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);

    }


}
