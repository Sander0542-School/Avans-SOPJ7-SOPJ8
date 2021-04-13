<?php

namespace App\Http\Requests\Admin\Map;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'subjects.*.id' => ['required', 'distinct', 'integer', 'exists:\App\Models\Subject,id'],
            'subjects.*.lat' => [
                'required',
                'distinct',
                'numeric',
                'regex:/^[+-]?((90\.?0*$)|(([0-8]?[0-9])\.?[0-9]*$))/'],
            'subjects.*.lon' => [
                'required',
                'distinct',
                'numeric',
                'regex:/^[+-]?((180\.?0*$)|(((1[0-7][0-9])|([0-9]{0,2}))\.?[0-9]*$))/']
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
            'subjects.*.id.required' => 'An id is required',
            'subjects.*.id.distinct' => 'An id must be distinct',
            'subjects.*.id.integer' => 'An id must be an integer',
            'subjects.*.id.exists' => 'An id must exist',

            'subjects.*.lat.required' => 'A latitude is required',
            'subjects.*.lat.distinct' => 'An id must be distinct',
            'subjects.*.lat.numeric' => 'A latitude is numeric',
            'subjects.*.lat.regex' => 'A latitude must match the regex',

            'subjects.*.lon.required' => 'A longitude is required',
            'subjects.*.lon.distinct' => 'An id must be distinct',
            'subjects.*.lon.numeric' => 'A longitude is numeric',
            'subjects.*.lon.regex' => 'A longitude must match the regex',
        ];
    }
}
