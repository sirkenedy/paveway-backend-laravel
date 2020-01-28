<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class BookStoreRequest extends BaseFormRequest
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
            'title' => 'required|string|unique:books,title|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'material' => 'required|mimes:doc,pdf,docx,zip'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Book title is required',
            'title.unique' => 'Book already exist',
            'author.required' => 'Book author field cannot be Empty',
            'publisher.required' => 'Book Publisher field is required!',
            'material.required' => 'Select a file to Upload'
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
            'title' => 'trim|lowercase',
            // 'material' => 'trim|lowercase|escape'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse( $validator->errors()
                , 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
