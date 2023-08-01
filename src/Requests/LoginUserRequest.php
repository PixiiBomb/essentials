<?php

namespace PixiiBomb\Essentials\Requests;

use JetBrains\PhpStorm\ArrayShape;

class LoginUserRequest extends UserRequest
{
    /**
     * Indicates if the validator should be stopped on the first rule failure.
     * @var bool
     */
    protected $stopOnFirstFailure = false;

    /**
     * The route suers should be redirected to if validation fails.
     * @var string
     */
    protected $redirectRoute = 'user.login';

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return string[]
     */
    #[ArrayShape([USERNAME => "string", PASSWORD => "string"])]
    public function rules(): array
    {
        return [
            USERNAME => 'required|string',
            PASSWORD => self::PASSWORD_RULE
        ];
    }

    /**
     * Get the error message for the defined validation rules.
     * @return string[]
     */
    #[ArrayShape(['username.required' => "string", 'password.required' => "string"])]
    public function messages(): array
    {
        return [
            'username.required' => 'Username cannot be empty.',
            'password.required' => 'Password cannot be empty.'
        ];
    }
}
