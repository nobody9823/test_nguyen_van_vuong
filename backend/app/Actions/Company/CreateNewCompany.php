<?php

namespace App\Actions\Company;

use App\Models\TemporaryCompany;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class CreateNewCompany
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'string', 'email', 'max:255', Rule::unique(TemporaryCompany::class, 'email'), Rule::unique(Company::class, 'email') ],
            'password' => [ 'required', 'string', new Password, 'confirmed' ],
            'password_confirmation' => ['required', 'string', new Password]
        ])->validate();

        return TemporaryCompany::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'image_url' => 'public/image/companySample.jpg'
        ]);
    }
}
