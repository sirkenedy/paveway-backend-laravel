<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class UserStoreRequest extends BaseFormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'unique_no' => 'required|string|max:255',
            'role' => 'required|string|exists:roles,title',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'firstname is required!',
            'lastname.required' => 'lastname is required!',
            'email.required' => 'email is required!',
            'password.required' => 'Password is required!',
            'password.confirmed' => 'Password must be equal to confirm password!',
            'unique_no.required' => 'your Unique Id/Personal Id is not supplied',
            'role.exists' => 'Invalid Role selected',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'firstname' => 'trim|capitalize|escape',
            'lastname' => 'capitalize|escape|strip_tags'
        ];
    }


    protected function failedValidation(Validator $validator)
{
    $response = new JsonResponse( $validator->errors()
             , 422);

    throw new \Illuminate\Validation\ValidationException($validator, $response);
}
}
