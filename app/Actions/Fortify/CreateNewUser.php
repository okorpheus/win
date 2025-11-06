<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['sometimes', Rule::in(['admin', 'teacher', 'student'])],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        if (! array_key_exists('role', $input)) {
            $input['role'] = 'student';
        }

        return User::create([
            'name' => $input['name'],
            'role' => $input['role'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);
    }
}
