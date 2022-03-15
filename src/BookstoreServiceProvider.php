<?php

namespace Yahyya\bookstore;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Yahyya\bookstore\App\Http\Middleware\CheckAuthToken;
use Yahyya\bookstore\App\Interfaces\BookRepositoryInterface;
use Yahyya\bookstore\App\Repositories\BookRepository;

class BookstoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookRepositoryInterface::class,BookRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadFactoriesFrom(__DIR__ . '/Database/Factories');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bookstore');
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('CheckAuthToken', CheckAuthToken::class);
    }


}
