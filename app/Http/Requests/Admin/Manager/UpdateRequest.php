<?php

namespace App\Http\Requests\Admin\Manager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('Super Admin');
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
                'max:255',
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique(User::class, 'email')->ignore($this->route('manager')->id),
            ],
            'role' => [
                'required',
                'integer',
                Rule::exists(Role::class, 'id')->where('guard_name', config('fortify.guard')),
            ],
        ];
    }
}
