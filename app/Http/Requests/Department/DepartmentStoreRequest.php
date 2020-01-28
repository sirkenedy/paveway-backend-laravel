<?php

namespace App\Http\Requests\Department;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class DepartmentStoreRequest extends BaseFormRequest
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
            'title' => 'required|string|unique:departments,dep_title|max:255',
            'key' => 'required|string|unique:departments,dep_key|max:255',
            'facultyId' => 'required|integer|exists:faculties,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Department title is required',
            'key.required' => 'Department key is required',
            'title.unique' => 'Department title already exist',
            'key.unique' => 'Department key already exist',
            'facultyId.required' => 'select a faculty that the department belongs to'
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
