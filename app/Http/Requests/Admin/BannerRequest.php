<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('post') ? ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072']
                                              : ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'];

        return [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => $imageRule,
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
