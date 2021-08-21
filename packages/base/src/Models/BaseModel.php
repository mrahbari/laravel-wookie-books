<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Base\Traits\Models\BaseAttributesTrait;

/**
 * Class BaseModel
 * @package Base\Models
 */
abstract class BaseModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    use BaseAttributesTrait;

}
