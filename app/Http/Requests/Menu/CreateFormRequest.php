<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'content' => 'required|max:1000',

            'thumb' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên Danh Mục',
            'thumb.required' => 'Vui lòng không để ảnh trống',
            'name.max' => 'Tên Danh Mục chỉ được phép tối đa 255 ký tự',
            'description.max' => 'Mô Tả Danh Mục chỉ được phép tối đa 255 ký tự',
            'content.max' => 'Mô Tả Chi Tiết Danh Mục chỉ được phép tối đa 1000 ký tự',


        ];
    }
}