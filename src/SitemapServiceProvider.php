<?php namespace Rumenx\Sitemap;

use Rumenx\Sitemap\Adapters\LaravelSitemapAdapter;
use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind('sitemap', function($app) {
            $config = $this->app->make('config')->get('sitemap');

            return new LaravelSitemapAdapter(
                $config,
                $this->app['cache'],
                $this->app['config'],
                $this->app['file'],
                $this->app['response'],
                $this->app['view']
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sitemap'];
    }
}
