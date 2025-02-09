<?php

namespace App\Http\Requests\Dashboard\Team;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }

    public function messages(): array {
        return [
            'organization_id.required' => 'The organization field is required.',
        ];
    }
}
