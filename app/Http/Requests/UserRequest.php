<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'passwordConfirmation' => ['required', 'string', 'min:8', 'same:password'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'firstName' => __('models/user.fillable.firstName'),
            'lastName' => __('models/user.fillable.lastName'),
            'email' => __('models/user.fillable.email'),
            'password' => __('models/user.fillable.password'),
            'passwordConfirmation' => __('models/user.fillable.passwordConfirmation'),
        ];
    }
}
