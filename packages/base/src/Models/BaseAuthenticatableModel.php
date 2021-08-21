<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Base\Traits\Models\BaseAttributesTrait;


/**
 * Class BaseAuthenticatableModel
 * @package Base\Models
 */
abstract class BaseAuthenticatableModel extends Authenticatable
{
    use SoftDeletes;
    use BaseAttributesTrait;
    use Notifiable;
    use HasApiTokens, HasFactory, Notifiable;

}
