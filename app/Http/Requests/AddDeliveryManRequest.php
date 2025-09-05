<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AddDeliveryManRequest extends FormRequest
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
                'name'     => 'required',
                'email'    => 'required|unique:users,email',
                'password' => 'required|min:8',
                'mobile'   => 'required|min:10',
                'images'   => 'required|array',
                'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
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
