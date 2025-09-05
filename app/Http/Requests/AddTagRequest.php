<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AddTagRequest extends FormRequest
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
            'tag_name' => 'required|string|max:255|unique:product_tags,name',
        ];
    }
        /**
     * @method
     * @param
     * @return
     */
    protected function failedValidation(Validator $validator)
  {
        $firstError = $validator->errors()->first();
        $response = response()->json([
            'message' => $firstError,
            'errors'  => [$firstError], 
        ], 422); 
        throw new ValidationException($validator, $response);
    }
}
