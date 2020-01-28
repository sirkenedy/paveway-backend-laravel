<?php

namespace App\Http\Requests\Faculty;

// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\BaseFormRequest;

class FacultyUpdateRequest extends BaseFormRequest
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
            'key' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Faculty title is required',
            'key.required' => 'Faculty key is required',
            // 'title.unique' => 'faculty title already exist',
            // 'key.unique' => 'faculty key already exist'
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
            'title' => 'trim|capitalize',
            'key' => 'trim|capitalize'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse( $validator->errors()
                , 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
