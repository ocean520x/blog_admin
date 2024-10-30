<?php

namespace App\Http\Requests;

use App\Rules\IsHotRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'sort' => ['numeric'],
            'category_id' => ['required', 'numeric'],
            'is_hot' => [new IsHotRule()]
        ];
    }

    public function attributes()
    {
        return [
            'title' => '帖子标题',
            'content' => '帖子内容',
            'sort' => '帖子排序',
            'category_id' => '帖子大类',
            'is_hot' => '是否热门帖子'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '帖子标题必须填写',
        ];
    }
}
