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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required','string','max:255'],
            'phone_number' => ['required','phone'],
            'gender'=> ['required',new Enum(Gender::class)],
            'age' => ['required', 'integer'],
            'whatsapp_number'=>['required','phone'],
            'facebook'=>['required','url'],
            'store_name'=> ['required','string'],
            'location' => ['required','string'],
            'logo' => ['required','image'],
            'details' => ['required','string'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
