<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /* this is for the algorithm of the 
    for ( $x=0; $x <= length_of_the_users; $x++) { 
            //
    }
    */
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
            'role_id' => 'numeric',
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required',
            'email.unique' => 'This email address is already used.',
            'email.email' => 'Your email address format is not correct. Please check it out.',
            'password.required' => 'You need to enter your password to login',
            'password.min' => 'Your password is too small. Please check again'
        ];
    } 

}
