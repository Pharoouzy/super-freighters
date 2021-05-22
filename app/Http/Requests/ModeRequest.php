<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'base_fare' => 'required|numeric|gt:0',
            'fare_per_kg' => 'required|numeric|gt:0',
            'expected_arrival_day' => 'sometimes|integer',
        ];
    }
}
