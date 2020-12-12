<?php

namespace App\Providers;

use App\Models\Event;
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

        
        $this->app->bind(Google_Service_YouTube::class, function (){
                $client = new Google_Client();
                $client->setApplicationName('test');
                $client->setDeveloperKey('AIzaSyCeRyYeYdU8Y4AkwCO-qka9dLeVBPwJo-Q');

                return new Google_Service_YouTube($client);
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
