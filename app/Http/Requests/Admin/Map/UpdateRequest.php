<?php

namespace App\Http\Requests\Admin\Map;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'subjects.*.id' => [
                'required',
                'distinct',
                'integer',
                'exists:\App\Models\Subject,id',
            ],
            'subjects.*.lat' => [
                'required',
                'distinct',
                'numeric',
                'regex:/^[+-]?((90\.?0*$)|(([0-8]?[0-9])\.?[0-9]*$))/',
            ],
            'subjects.*.lon' => [
                'required',
                'distinct',
                'numeric',
                'regex:/^[+-]?((180\.?0*$)|(((1[0-7][0-9])|([0-9]{0,2}))\.?[0-9]*$))/',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'subjects.*.id.required' => 'Een id is vereist',
            'subjects.*.id.distinct' => 'Een id moet onderscheiden zijn van anderen',
            'subjects.*.id.integer' => 'Een id moet wel een getal zijn',
            'subjects.*.id.exists' => 'Een id moet wel bestaan',

            'subjects.*.lat.required' => 'Een breedtegraad is vereist',
            'subjects.*.lat.distinct' => 'Een breedtegraad moet onderscheiden zijn van anderen',
            'subjects.*.lat.numeric' => 'Een breedtegraad is numeriek',
            'subjects.*.lat.regex' => 'Een breedtegraad moet overeenkomen met de reguliere expressie',

            'subjects.*.lon.required' => 'Een lengtegraad is vereist',
            'subjects.*.lon.distinct' => 'Een lengtegraad moet onderscheiden zijn van anderen',
            'subjects.*.lon.numeric' => 'Een lengtegraad is numeriek',
            'subjects.*.lon.regex' => 'Een lengtegraad moet overeenkomen met de reguliere expressie',
        ];
    }
}
