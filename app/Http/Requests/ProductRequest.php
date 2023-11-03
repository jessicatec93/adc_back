<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'              => 'required|string',
            'description'       => 'nullable|string',
            'price_per_unit'    => 'required|numeric|gte:0',
            'classification_id' => 'required|integer|exists:cat_classifications,id',
            'expiration_at'     => 'required|date',
            'storage'           => 'nullable|integer|gte:0',
        ];
    }
}
