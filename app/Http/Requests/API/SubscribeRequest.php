<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:150|unique:subscribers',
        ];
    }
}
