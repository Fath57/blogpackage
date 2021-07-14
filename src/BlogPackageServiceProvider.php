<?php
namespace Arafath57\BlogPackage;

use Arafath57\BlogPackage\Console\MakeFooCommand;
use Arafath57\BlogPackage\View\Components\Alert;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Arafath57\BlogPackage\Console\InstallBlogPackage;

class BlogPackageServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('calculator',function($app){
            return new Calculator();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'blogpackage');


    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration(): array
    {
        return [
            'prefix' => config('blogpackage.prefix'),
            'middleware' => config('blogpackage.middleware'),
        ];
    }
    public function boot(){
        $this->loadViewComponentsAs('blogpackage', [
            Alert::class,
        ]);
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'blogpackage');
        //registering routes
        $this->registerRoutes();
        //$this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        //load migrations automatically so that end-users can just run php artisan migrate
        /*
         * rename migration files properly as laravel convention
         */
        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()){
            $this->commands([
                InstallBlogPackage::class,
                MakeFooCommand::class
            ]);

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('blogpackage.php'),
            ], 'config');

            // Export the migration
            if (! class_exists('CreatePostsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_fath_posts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_posts_table.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }
            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/blogpackage'),
            ], 'views');

            // Publish view components
            $this->publishes([
                __DIR__.'/../src/View/Components/' => app_path('View/Components'),
                __DIR__.'/../resources/views/components/' => resource_path('views/components'),
            ], 'view-components');
        }

    }

}