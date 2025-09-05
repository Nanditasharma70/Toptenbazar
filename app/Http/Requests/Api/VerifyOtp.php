<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyOtp extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'email' => 'required|email',
            'otp'   => 'required|digits:4',
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
