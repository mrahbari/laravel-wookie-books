<?php
/**
 * Http/Middleware/DefaultParameterAllocation.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 *
 * php artisan make:middleware DefaultParametersAllocating
 */
namespace Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class DefaultParametersAllocating
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Step 1: set default values
        URL::defaults([
            'api_version' => 'v1',
        ]);

        //Step 2: Set route patterns
        Route::pattern('api_version', '[a-zA-Z0-9-]+');

        //Step 3: Ignore default route parameters in controller methods entrance parameters
        $request->route()->forgetParameter('api_version');

        return $next($request);
    }
}
