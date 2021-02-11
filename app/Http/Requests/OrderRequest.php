<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * HTTP validation rules.
     *
     * @var array
     */
    protected $rules = [
        'POST' => [
            'order_number' => ['required', 'max:255'],
            'product_code' => ['required', 'max:255'],
            'customer_name' => ['required'],
            'customer_address' => ['required'],
            'email' => ['required', 'email'],
            'result' => ['required'],
        ],
        'PATCH' => [
            'order_number' => ['required', 'max:255'],
            'product_code' => ['required', 'max:255'],
            'customer_name' => ['required'],
            'customer_address' => ['required'],
            'email' => ['required', 'email'],
            'result' => ['required'],
        ],
    ];

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
        return $this->rules[$this->method()];
    }
}
