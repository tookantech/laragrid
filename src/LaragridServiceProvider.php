<?php

namespace Aryala7\Laragrid;

use Illuminate\Support\ServiceProvider;

class LaragridServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
			__DIR__ . '/../config/laragrid.php', 'laragrid'
		);

        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laragrid.php' => config_path('laragrid.php'),
        ]);
         /**
         * Configurations that needs to be done by user.
         */
        $this->publishes(
            [
                __DIR__ . '/../config/laragrid.php' => config_path('laragrid.php'),
            ],
            'config'
        );
    }
}
