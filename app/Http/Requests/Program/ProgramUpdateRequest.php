<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class ProgramUpdateRequest extends BaseFormRequest
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
            'title' => 'required|string|max:255',
            'key' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'program title is required',
            'key.required' => 'program key is required',
            'department_id.required' => 'select a department that the program belongs to'
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
