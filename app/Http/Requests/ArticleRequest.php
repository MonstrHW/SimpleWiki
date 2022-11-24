<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Str;

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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->header),
        ]);

        $result = $this->collect('sections')->map(function ($section, $key) {
            $section['slug'] = Str::slug($section['header']);
            return $section;
        })->toArray();

        $this->merge(['sections' => $result]);
    }

    public function attributes()
    {
        return [
            'sections.*.slug' => 'slug',
            'sections.*.header' => 'header',
            'sections.*.body' => 'body',
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'The :attribute of header has already been taken.',

            'sections.*.slug.distinct' => 'The :attribute of header has a duplicate value.',
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
        $max = fn ($value) => 'max:' . $value;

        return [
            'slug' => 'unique:articles,slug',
            'header' => ['required', $max(config('size.article.header'))],
            'foreword' => ['required', $max(config('size.article.foreword'))],
            'image' => 'mimes:jpg,bmp,png',

            'sections.*.slug' => 'distinct',
            'sections.*.header' => [
                'required_unless:sections.*.body,null',
                $max(config('size.section.header')),
            ],
            'sections.*.body' => [
                'required_unless:sections.*.header,null',
                $max(config('size.section.body')),
            ],
        ];
    }
}
