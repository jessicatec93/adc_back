<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'delivery_at'        => 'nullable|date',
            'deadline_at'        => 'required|date',
            'description'        => 'nullable|string',
            'price_per_unit'     => 'required|numeric|gte:0',
            'total_price'        => 'required|numeric|gte:0',
            'required_quantity'  => 'required|integer|gte:0',
            'status_id'          => 'required|integer|exists:cat_order_statuses,id',
            'product_id'         => 'required|integer|exists:products,id',
        ];
    }
}
