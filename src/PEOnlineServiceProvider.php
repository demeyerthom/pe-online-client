<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26-1-17
 * Time: 22:35
 */

namespace Demeyerthom\PeOnline;


use Illuminate\Support\ServiceProvider;

class PEOnlineServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('pe-online', function () {
            return new Service(config('pe_online.settings'), config('pe_online.chunk_size'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/configuration/pe_online.php' => config_path('pe_online.php'),
        ]);
    }

}