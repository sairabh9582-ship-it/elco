<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\SiteSetting;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Wishlist;

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
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // Force HTTPS for all generated URLs to prevent 405/Method mismatch on redirects
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        if (Schema::hasTable('site_settings')) {
            $siteSetting = SiteSetting::first();
            if (!$siteSetting) {
                $siteSetting = new SiteSetting(); 
            }
            View::share('siteSetting', $siteSetting);
        }

        if (Schema::hasTable('menus')) {
            $headerMenus = Menu::where('status', true)->where('type', 'header')->orderBy('order')->get();
            $footerMenus = Menu::where('status', true)->where('type', 'footer')->orderBy('order')->get();
            View::share('headerMenus', $headerMenus);
            View::share('footerMenus', $footerMenus);
        }

        if (Schema::hasTable('categories')) {
            $categories = Category::all();
            View::share('headerCategories', $categories);
        }

        View::composer('*', function ($view) {
            $compareCount = count(session('compare_products', []));
            $wishlistCount = 0;
            if (Auth::check()) {
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            }
            $view->with('compareCount', $compareCount);
            $view->with('wishlistCount', $wishlistCount);
        });
    }
}
