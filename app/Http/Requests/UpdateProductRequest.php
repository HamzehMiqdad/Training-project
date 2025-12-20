<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'details' => ['required','string'],
            'image' => ['nullable','image'],
            'category' => ['required','string'],
            'subcategory' => ['nullable','string'],
            'code' => ['nullable','string'],
            'price'=>['nullable','integer'],
            'availabe_for_sale' => ['nullable'],
            'cat1' => ['nullable','string'],
            'cat2' => ['nullable','string'],
            'cat3' => ['nullable','string'],
            'cat4' => ['nullable','string'],
            'cat5' => ['nullable','string'],
        ];
    }
}
