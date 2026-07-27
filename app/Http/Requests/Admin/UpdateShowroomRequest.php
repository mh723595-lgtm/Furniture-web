<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShowroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('showrooms', 'slug')->ignore($this->route('showroom'))],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'whatsapp_number' => ['required', 'string', 'max:30'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'operational_hours' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'gallery.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'gmaps_embed' => ['nullable', 'string'],
            'gmaps_url' => ['nullable', 'url', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
