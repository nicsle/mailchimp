<?php

//namespace App\Providers;
namespace Laravel5Tutorial\Providers;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                'Laravel5Tutorial\Storage\Task\TaskRepository',
                'Laravel5Tutorial\Storage\Task\EloquentTaskRepository'
        );
    }
}
