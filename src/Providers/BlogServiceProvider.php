<?php
namespace Romalytvynenko\Blog\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->setupRoutes($this->app->router);
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @return void
	 */
	public function setupRoutes(Router $router)
	{
		$router->group(['namespace' => 'Romalytvynenko\Blog\Http\Controllers'], function ($router) {
			require __DIR__ . '/../Http/routes.php';
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
