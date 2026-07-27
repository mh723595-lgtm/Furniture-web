<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('post') ? ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']
                                              : ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];

        return [
            'title' => ['nullable', 'string', 'max:255'],
            'image' => $imageRule,
            'alt_text' => ['nullable', 'string', 'max:255'],
            'product_id' => ['nullable', 'exists:products,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
