<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:30 PM
 */
namespace App\Models;

use Publisher\Models\Book as BaseBook;

/**
 * @method static latest(string $string)
 * @method static find(int $authorId)
 */
class Book  extends BaseBook
{
    // ُTODO: I had a problem during the test just to avoid wasting time with this solution!!!!!!
}
