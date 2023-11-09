<?php

namespace TomatoPHP\TomatoProducts;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;


class TomatoProductsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoProducts\Console\TomatoProductsInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-products.php', 'tomato-products');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-products.php' => config_path('tomato-products.php'),
        ], 'tomato-products-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-products-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-products');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-products'),
        ], 'tomato-products-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-products');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/tomato-products'),
        ], 'tomato-products-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

    }

    public function boot(): void
    {
        TomatoMenu::register([
            Menu::make()
                ->group(__('Products'))
                ->route('admin.products.index')
                ->label(__('Products'))
                ->icon('bx bxs-cart-alt'),
        ]);
    }
}
