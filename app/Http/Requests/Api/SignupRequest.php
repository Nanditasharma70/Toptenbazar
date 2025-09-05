<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SignupRequest extends FormRequest
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
        $validateData = [
            // 'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', 
        ];

        if (User::where('email', $request->email)->exists()) {
            $validateData['email'] = 'required|email';
        }
        return $validateData;
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
