<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 16:54 PM
 */

namespace Publisher\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'author_id'=>'required',
            //'image_url'=>'required|regex:/^[www.][a-zA-z0-9 \/&@+#%?=~_\!:,.-]*[-a-z0-9+&@#\/%=~_-]+$/',
            'title'=>'required|min:3|regex:/^[a-zA-Z0-9 #.]+$/',
            'price'=>'required|numeric|min:0.1', // numeric|min:0.1
        ];
    }
}
