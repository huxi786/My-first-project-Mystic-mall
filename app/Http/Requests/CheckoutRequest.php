<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required'
        ];
    }
}
