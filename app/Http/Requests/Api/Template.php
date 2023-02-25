<?php

namespace App\Http\Requests\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Foundation\Http\FormRequest;

class Template extends FormRequest
{

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Controller();
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            $response->respondBadRequest(
                $validator->errors(),
                true,
                'Bad Request!'
            )
        );
    }
}
