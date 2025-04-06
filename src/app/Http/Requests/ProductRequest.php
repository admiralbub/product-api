<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Responses\ApiResponse;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'category' => ['required', 'string'],
            'attributes' => ['required'],
        ];
    }

    /**
     * Override the failed validation method to customize the error response.
     */
    public function failedValidation(Validator $validator)
    {
        // В случае ошибки валидации выбрасываем исключение с кастомным сообщением.
        throw new ValidationException($validator, response()->json([
            'status' => 422,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}