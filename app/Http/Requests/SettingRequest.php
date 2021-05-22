<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest {
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
            'app_name' => 'sometimes|string',
            'app_title' => 'sometimes|string',
            'custom_tax' => 'sometimes|numeric|between:1,100',
            'default_email_address' => 'sometimes|email',
            'default_address' => 'sometimes|string',
            'default_phone_number' => 'sometimes|string',
            'currency_code' => 'sometimes|string|max:3|min:3',
            'currency_symbol' => 'sometimes|string|max:1|min:1',
            'paystack_env' => 'sometimes|string|in:live,test',
        ];
    }
}
