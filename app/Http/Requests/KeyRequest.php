<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class KeyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'max:200', 'string'],
            'email' => ['required', 'max:200', 'email', 'unique:users'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'confirmed']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'email.unique' => 'Email already registered',
        ];
    }


}
