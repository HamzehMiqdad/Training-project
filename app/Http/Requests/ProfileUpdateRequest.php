<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'phone_number' => 'required|string',
            'whatsapp'     => 'nullable|string',
            'facebook'     => 'nullable|string',
            'store_name'   => 'required|string|max:255',
            'country'      => 'required|string',
            'city'         => 'required|string',
            'details'      => 'nullable|string',
            'logo'         => 'nullable|image|max:2048',
        ];
    }
}
