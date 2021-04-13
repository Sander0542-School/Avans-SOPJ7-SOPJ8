<?php

namespace App\Http\Requests\Admin\Menu;

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
            'subject' => ['required', 'array'],
            'subject.*.id' => ['required', 'nullable', 'integer'],
            'subject.*.domain_id' => ['required', 'integer', 'exists:domains,id'],
            'subject.*.name' => ['required', 'string', 'max:255'],
            'subject.*.order' => ['required', 'integer'],
        ];
    }
}
