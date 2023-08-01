<?php

namespace PixiiBomb\Essentials\Requests;

use JetBrains\PhpStorm\ArrayShape;

class RegisterUserRequest extends UserRequest
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
    protected $redirectRoute = 'user.register';

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
    #[ArrayShape([USERNAME => "string", EMAIL => "string", PASSWORD => "string"])]
    public function rules(): array
    {
        return [
            USERNAME => self::USERNAME_NEW_RULE,
            EMAIL => self::EMAIL_RULE,
            PASSWORD => self::PASSWORDS_RULE
        ];
    }

    /**
     * Get the error message for the defined validation rules.
     * @return string[]
     */
    #[ArrayShape(['username.required' => "string", 'password.confirmed' => "string"])]
    public function messages(): array
    {
        return [
            'username.required' => 'Username cannot be empty.',
            'username.min' => 'Username must be a minimum of '.UserRequest::MIN[USERNAME].' characters',
            'username.max' => 'Username must be a maximum of '.UserRequest::MAX[USERNAME].' characters',
            'password.confirmed' => 'Passwords must match',

        ];
    }



}
