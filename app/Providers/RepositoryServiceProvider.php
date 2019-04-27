<?php

namespace Clio\Providers;

use Illuminate\Support\ServiceProvider;
use Clio\Repositories\ContentType\ContentTypeCache;
use Clio\Repositories\ContentType\ContentTypeInterface;
use Clio\Repositories\ContentType\ContentTypeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ContentTypeInterface::class, function () {
            return new ContentTypeCache(new ContentTypeRepository());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
