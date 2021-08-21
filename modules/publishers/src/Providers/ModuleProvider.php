<?php
/**
 * Providers\ModuleProvider.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:37 PM
 */

namespace Publisher\Providers;

use Publisher\Models\Author;
use Base\Support\Helper;
use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * php artisan vendor:publish
     * @return void
     */
    public function boot()
    {
        // Call load resources function
        $this->loadResources();

        // Call publish resources function
        $this->publishResources();
    }

    /**
     * Register the application services.
     *
     * @return void
     */

    public function register()
    {
        /**
         * Load helpers
         */
        Helper::loadModuleHelpers(__DIR__);

        /**
         * Load and merge configs
         */
        $configs = Helper::loadModuleConfig(__DIR__);
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }

        /**
         * Bind Facades
         */
        $this->bindFacades();

        /**
         * Base providers
         */
        $this->registerProviders();
    }

    /**
     * Load Resources
     *
     * @return void
     */
    private function loadResources()
    {
        /**
         * Load translations
         * usage: echo trans('publishers::authors.commons.name');
         */
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'publishers');
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        /**
         * publish config file to config folder
         * in everywhere: config('post.names')
         */
        $this->publishes([__DIR__ . '/../../config' => base_path('config')], 'config');

        /**
         * publish database files to database folder
         * in command: php artisan migrate
         */
        $this->publishes([
            __DIR__ . '/../../database' => base_path('database'),
        ], 'database');
    }

    /**
     * Bind Facades.
     *
     * @return void
     */
    private function bindFacades()
    {
        // bind the postData Facade
        $this->app->bind('author', static function () {
            return new Author();
        });
    }

    /**
     * Register Providers.
     *
     * @return void
     */
    private function registerProviders()
    {
        $this->app->register(RouteServiceProvider::class);
    }

}
