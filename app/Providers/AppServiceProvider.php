<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('layout', function ($view) {
            $carrinho = session('cart', []);
            
           
    $itemCount = count($carrinho);
            $view->with('itemCount', $itemCount);
        });
    }
    
    
        }

