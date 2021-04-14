<?php

namespace App\Http\Requests\Admin\Layer;

use App\Models\Layer;
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
        return $this->user() && $this->user()->can('layers.update.'.$this->route('layer')->id);
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
                Rule::unique(Layer::class, 'name')->ignore($this->route('layer')->id),
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
