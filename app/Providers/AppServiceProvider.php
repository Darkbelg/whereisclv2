<?php

namespace App\Providers;

use App\Models\Event;
use App\Service\YoutubeApi;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(YoutubeApi::class, function($app){
            return new YoutubeApi();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y'); ?>";
        });
    }
}
