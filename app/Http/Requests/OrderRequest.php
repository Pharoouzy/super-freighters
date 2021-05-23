<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'weight' => 'required|string',
            'item_name' => 'required|string',
            'phone_number' => 'required|string',
            'mode' => 'required|integer|exists:modes,id',
            'origin' => 'required|integer|exists:countries,id',
            'destination' => 'required|integer|exists:countries,id|different:origin',
        ];
    }
}
