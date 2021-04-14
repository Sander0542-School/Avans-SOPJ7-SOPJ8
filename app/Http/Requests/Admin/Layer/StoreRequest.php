<?php

namespace App\Http\Requests\Admin\Layer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() && $this->user()->can('layers.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:\App\Models\Layer,name',
            ],
            'content' => [
                'required',
            ],
            'parent' => [
                'nullable',
                'string',
            ],
        ];
    }
}
