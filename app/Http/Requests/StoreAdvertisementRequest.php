<?php

namespace App\Http\Requests;

use App\Enums\AdPlace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreAdvertisementRequest extends FormRequest
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
            'owner' => ['string','required'],
            'link' => ['string','url'],
            'place' => ['required'],
            'image'=>['nullable','image'],
            'start_time' => ['required','date'],
            'end_time'=> ['required','date']
        ];
    }
}
