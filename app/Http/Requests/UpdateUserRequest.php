<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'sucess' => false,
            'error' => true,
            'message' => 'echec de validation',
            'errorlist' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le champs nom ne doit pas être vide',
            'lastname.required' => 'Le champs prenom ne doit pas être vide',
            'phone.required' => 'Le champs telephone ne doit pas être vide',
            'username.required' => 'Le champs pseudo ne doit pas être vide',
            'email.required' => 'Le champs email ne doit pas être vide',
            'password.required' => 'Le champs mot de passe ne doit pas être vide'
        ];
    }
}
