<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'sections.*.header' => 'header',
            'sections.*.body' => 'body',
        ];
    }

    public function messages()
    {
        return [
            'sections.*.header.required_unless' => 'The :attribute field is required if :other is non-empty.',
            'sections.*.body.required_unless' => 'The :attribute field is required if :other is non-empty.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'header' => 'required|max:80',
            'foreword' => 'required|max:1024',
            'image' => 'mimes:jpg,bmp,png',

            'sections.*.header' => 'required_unless:sections.*.body,null|max:80',
            'sections.*.body' => 'required_unless:sections.*.header,null|max:2048',
        ];
    }
}
