<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginUser extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'sucess' => false,
            'error' => true,
            'status' => 422,
            'message' => 'echec de validation',
            'errorlist' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'email.required' => 'Le champs email est manquant',
            'email.email' => 'ceci n\'est pas un email',
            'email.exists' => 'cette email n\'existe deja',
            'password.required' => 'Le champs mot de passe est manquant'
        ];
    }
}
