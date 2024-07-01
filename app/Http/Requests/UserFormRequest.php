<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => ['required','min:5','regex:/^[a-zA-Z\ ]+$/'],
            'telephone' => ['required','min:5','regex:/^[0-9]+$/'],
            'email' => ['required','email'],
            'password' =>['required','min:5'],
            'image' => ['image','max:2000']
        ];
    }
}
