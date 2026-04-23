<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use TailwindMerge\Contracts\TailwindMergeContract;
use TailwindMerge\Laravel\Facades\TailwindMerge;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            TailwindMergeContract::class,
            static fn (): TailwindMerge => TailwindMerge::factory()
                ->withConfiguration(config('tailwind-merge', []))
                ->withCache(Cache::driver('array')) // @phpstan-ignore-line
                ->make(),
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
