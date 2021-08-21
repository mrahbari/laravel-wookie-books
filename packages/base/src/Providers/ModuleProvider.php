<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Providers;

use Base\Support\Helper;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ModuleProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * php artisan vendor:publish
     * @return void
     */
    public function boot()
    {
        /**
         * publish config file to config folder
         * in everywhere: config('base.user_guard')
         */
        $this->publishes([
            __DIR__ . '/../../config' => base_path('config'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Load translations
         * usage: echo trans('base::exception.validation.exception');
         */
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'base');


        /**
         * Load helpers
         */
        Helper::loadModuleHelpers(__DIR__);
        //echo hashids_encode(1);
        //die();

        /**
         * Load and merge configs
         */
        $configs = Helper::loadModuleConfig(__DIR__);
        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }

        /**
         * Other providers that should be add as modules
         */
        foreach (config('base.extra_provider', []) as $item) {
            $this->app->register($item);
        }

        /**
         * Other provider's alias that should be added
         */
        foreach (config('base.extra_alias', []) as $alias => $provider) {
            $this->app->alias($alias, $provider);
        }
    }
}
