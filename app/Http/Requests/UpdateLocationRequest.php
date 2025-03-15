<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
            'color' => ['sometimes', 'regex:/^#([A-Fa-f0-9]{6})$/']
        ];

    }

    public function messages () {
        return [
            'name.string' => 'Konum adı metin olmalıdır.',
            'latitude.numeric' => 'Enlem bir sayı olmalıdır.',
            'longitude.numeric' => 'Boylam bir sayı olmalıdır.',
            'color.regex' => 'Renk kodu #FFFFFF formatında olmalıdır.'
        ];
    }
}





