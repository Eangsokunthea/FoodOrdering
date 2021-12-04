<?php

namespace App\Providers;

use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('FrontEnd.include.banner', function ($view){
        //     $view->with('categories', Category::where('category_status', 1)->get());
        // });
        
        Paginator::useBootstrap();
    }
}
