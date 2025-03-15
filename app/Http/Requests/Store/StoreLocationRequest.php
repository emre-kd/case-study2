<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'color' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/']
        ];

    }

    public function messages() {

        return [
            'name.required' => 'Konum adı zorunludur.',
            'latitude.required' => 'Enlem bilgisi zorunludur.',
            'latitude.numeric' => 'Enlem bir sayı olmalıdır.',
            'longitude.required' => 'Boylam bilgisi zorunludur.',
            'longitude.numeric' => 'Boylam bir sayı olmalıdır.',
            'color.required' => 'Renk kodu zorunludur.',
            'color.regex' => 'Renk kodu #FFFFFF formatında olmalıdır.'
        ];


    }
}




