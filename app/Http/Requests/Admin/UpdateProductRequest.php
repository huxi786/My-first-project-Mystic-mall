<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'is_flash_deal' => 'nullable',
            'discount_price' => 'nullable|numeric|lt:price',
            'flash_deal_end' => 'nullable|date|after:now',
        ];
    }
}
