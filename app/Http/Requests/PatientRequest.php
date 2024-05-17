<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'document' => 'required|integer',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'birthday' => 'required|date:Y-m-d',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|integer',
            'genre' => 'required|in:Male,Female',
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
            'document' => __('models/diagnostic.fillable.name'),
            'firstName' => __('models/diagnostic.fillable.description'),
            'lastName' => __('models/diagnostic.fillable.description'),
            'birthday' => __('models/diagnostic.fillable.description'),
            'email' => __('models/diagnostic.fillable.description'),
            'genre' => __('models/diagnostic.fillable.description'),
        ];
    }
}
