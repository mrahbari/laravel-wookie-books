<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Http\Controllers\Backend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Base\Traits\Jsons\JsonResponseTrait;

class BaseApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use JsonResponseTrait;

    protected $service;
    protected $redirectRoute;
    protected $apiColumns;
    protected $apiAllColumns;
    protected $apiOnlyColumns;


    /**
     * Initialize  BaseController constructor.
     */
    public function __construct()
    {
    }
}
