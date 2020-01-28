<?php

namespace App\Http\Requests\Faculty;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class FacultyStoreRequest extends FormRequest
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
            'title' => 'required|string|unique:faculties,fac_title|max:255',
            'key' => 'required|string|unique:faculties,fac_key|max:255'
        ];
    }

    public function treatment()
    {
        $input = (object) $this->all();

        $input['fac_title'] = $input->title;
        // $input->lastname = ucfirst($input->lastname);

        return (array) $input;
    }

    public function messages()
    {
        return [
            'title.required' => 'Faculty title is required',
            'key.required' => 'Faculty key is required',
            'title.unique' => 'faculty title already exist',
            'key.unique' => 'faculty key already exist'
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
            'title' => 'trim|uppercase',
            'key' => 'trim|uppercase'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse( $validator->errors()
                , 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
