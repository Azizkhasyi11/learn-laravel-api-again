<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCostumerRequest extends FormRequest
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
            'no_ktp' => 'string',
            'name' => 'string',
            'date_of_birth' => 'date',
            'email' => 'string',
            'phone' => 'string',
            'description' => 'string',
            'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
