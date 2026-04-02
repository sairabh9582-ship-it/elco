<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Addon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AddonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Fallback autoloader for Addons in case composer dump-autoload is restricted
        spl_autoload_register(function ($class) {
            $prefix = 'Addons\\';
            $base_dir = base_path('addons/');

            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return;
            }

            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Only proceed if table exists (to avoid errors during migration)
        if (!\Illuminate\Support\Facades\Schema::hasTable('addons')) {
            return;
        }

        try {
            $activeAddons = Addon::where('status', true)->get();

            foreach ($activeAddons as $addon) {
                $name = ucfirst($addon->unique_identifier);
                $addonPath = base_path('addons/' . $name);

                if (File::exists($addonPath)) {
                    // Load Routes
                    if (File::exists($addonPath . '/routes.php')) {
                        $this->loadRoutesFrom($addonPath . '/routes.php');
                    }

                    // Load Views
                    if (File::exists($addonPath . '/Views')) {
                        $this->loadViewsFrom($addonPath . '/Views', strtolower($addon->unique_identifier));
                    }
                }
            }
        } catch (\Exception $e) {
            // Silently fail if something goes wrong to not break the whole site
            \Illuminate\Support\Facades\Log::error('Addon loading error: ' . $e->getMessage());
        }
    }
}
