<?php

namespace App\Providers;

use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TypeRoomRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\HomestayRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TypeRoomRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(HomestayRepositoryInterface::class, HomestayRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(TypeRoomRepositoryInterface::class, TypeRoomRepository::class);
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
