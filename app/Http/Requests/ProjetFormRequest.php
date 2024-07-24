<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetFormRequest extends FormRequest
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
            'nom' => ['required','min:10'],
            'description' => ['nullable','min:10'],
            'budget' =>['nullable','regex:/^[0-9]+$/'],
            'date_fin'=>['nullable','date'],
            'image' => ['nullable','image','max:2000'],
            'createur_id' => ['regex:/^[0-9]+$/'],
            'administrateur_id' => ['regex:/^[0-9]+$/'],
            'projet_parent_id' => ['nullable','regex:/^[0-9]+$/']
        ];
    }
}
