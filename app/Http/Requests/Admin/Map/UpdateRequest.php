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
            'subjects.*.id' => ['required', 'integer', 'exists:\App\Models\Subject,id'],
            'subjects.*.lat' => ['required', 'numeric'],
            'subjects.*.lon' => ['required', 'numeric']
        ];
    }
}
