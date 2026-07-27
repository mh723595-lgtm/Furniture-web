<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'description' => ['nullable', 'string'],
            'specification' => ['nullable', 'string'],
            'material' => ['nullable', 'string', 'max:255'],
            'dimension' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'status' => ['required', 'in:active,inactive,draft'],
            'is_featured' => ['nullable', 'boolean'],
            'is_best_seller' => ['nullable', 'boolean'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'whatsapp_link' => ['nullable', 'string', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ];
    }
}
