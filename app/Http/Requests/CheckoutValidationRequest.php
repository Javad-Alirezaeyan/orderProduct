<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'shippingFee' =>'required',
            'customer.firstName' => 'required|min:3',
            'customer.lastName' => 'required|min:3',
            'customer.email' => 'required|email',
            'customer.address' => 'required|min:3',
            'card.cardNumber' => 'required|integer|min:16',
            'card.year' => 'required|integer|min:4',
            'card.month'=> 'required|max:2',
            'card.cvv' => 'required|integer|min:3',
            'product.id' => 'required|integer'
        ];

        return $rules;
    }
}
