<?php

namespace App\Http\Requests\Dashboard\Organization;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'description' => 'required|string|min:3|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }
}
