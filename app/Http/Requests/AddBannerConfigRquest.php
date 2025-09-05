<?php

namespace App\Http\Requests;

use App\Models\ImageConfig;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AddBannerConfigRquest extends FormRequest
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
         $type = 'banner';
         $config = ImageConfig::where('type', $type)->first();
        return [
            'name' => 'required|string|max:255',
            'images'    => 'required|array',
              'images.*' => [
             'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
                function ($attribute, $value, $fail) use ($config) {
                    if ($value instanceof UploadedFile && $config) {
                        [$width, $height] = getimagesize($value->getRealPath());
                        if ($width != $config->width || $height != $config->height) {
                            $fail("Each image must be exactly {$config->width}x{$config->height} pixels.");
                        }
                    }
                },
            ],
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
