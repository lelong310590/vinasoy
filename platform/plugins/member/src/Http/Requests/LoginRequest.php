<?php

namespace Botble\Member\Http\Requests;

use Botble\Support\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hrm'    => 'required|string|',
            'password' => 'required|string',
        ];
    }
}
