<?php

namespace PixiiBomb\Essentials\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    protected string $successRoute = 'user.dashboard';

    const
        MIN = [
            USERNAME => 6,
            EMAIL => 10,
            PASSWORD => 12
        ],
        MAX = [
            USERNAME => 30,
            EMAIL => 100,
            PASSWORD => 100
        ];

    const
        USERNAME_RULE = 'required|string',
        USERNAME_NEW_RULE = self::USERNAME_RULE.'|min:'
                            .self::MIN[USERNAME].'|max:'.self::MAX[USERNAME].'|unique:users',
        EMAIL_RULE = 'required|string|email|min:10|max:100|unique:users',
        PASSWORD_RULE = 'required|string',
        PASSWORDS_RULE = self::PASSWORD_RULE.'|min:12|max:100|confirmed';

    public function getSuccessRoute(): string { return $this->successRoute; }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator->errors())->withInput()
        );
    }

}
