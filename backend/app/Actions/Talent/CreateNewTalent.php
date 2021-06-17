<?php

namespace App\Actions\Talent;

use App\Models\Talent;
use App\Models\TemporaryTalent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;


class CreateNewTalent
{
    /**
     * Validate and create a newly registered talent.
     *
     * @param  array  $input
     * @return \App\Models\TemporaryTalent
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(TemporaryTalent::class, 'email'),
                Rule::unique(Talent::class, 'email'),
            ],
            'password' => ['required',
                'string',
                new Password
            ],
            'company_id' => [
                'integer'
            ],
        ])->validate();

        return TemporaryTalent::create([
            'name' => $input['email'],
            'company_id' => $input['company_id'],
            'email' => $input['email'],
            'password' => $input['password'],
            'image_url' => 'public/image/talentSample.jpg',
        ]);
    }
}
