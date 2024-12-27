<?php
/*
 * @Author: Ocean ocean_520x@bytespark.app
 * @Date: 2024-12-26 11:31:00
 * @LastEditors: Ocean ocean_520x@bytespark.app
 * @LastEditTime: 2024-12-27 16:30:04
 * @FilePath: /blog_admin/app/Http/Requests/UpdateConfigRequest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
