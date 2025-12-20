<?php

namespace App\Http\Requests\Auth;

use App\Enums\Gender;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required','string','max:255'],
            'phone_number' => ['required'],
            'gender'=> ['required',new Enum(Gender::class)],
            'age' => ['required', 'integer'],
            'whatsapp'=>['required'],
            'facebook'=>['required','url'],
            'store_name'=> ['required','string'],
            'location' => ['required','string'],
            'logo' => ['nullable','image'],
            'details' => ['nullable','string'],
            'password' => ['required','string','min:8'],
            'country' => ['required','string'],
            'city' => ['required','string'],
            'user_image' => ['required','image'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'unique:'.User::class,
                'max:255',
            ]
        ];
    }
}
