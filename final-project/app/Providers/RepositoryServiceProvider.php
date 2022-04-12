<?php

namespace App\Providers;

use App\Interfaces\BookingDetailRepositoryInterface;
use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\PasswordResetRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TypeRoomRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BookingDetailRepository;
use App\Repositories\BookingRepository;
use App\Repositories\HomestayRepository;
use App\Repositories\PasswordResetRepository;
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
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(BookingDetailRepositoryInterface::class, BookingDetailRepository::class);
        $this->app->bind(PasswordResetRepositoryInterface::class, PasswordResetRepository::class);

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
