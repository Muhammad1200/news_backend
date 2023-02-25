<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\Template;


class OTPRequests extends Template
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
        return [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
//            'otp' => 'required|numeric|min:4|max:4',
        ];
    }
}
