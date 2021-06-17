<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Project;
use App\Models\Talent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Talent::truncate();
        Company::truncate();
        Company::create([
            'name' => '所属なし',
            'email' => 'test@nobelongs.co.jp',
            'password' => 'valleyin',
            'image_url' => 'public/image/companySample.jpg'
        ]);
        Company::create([
            'name' => 'valleyin',
            'email' => 'test@valleyin.co.jp',
            'password' => 'valleyin',
            'image_url' => 'public/image/companySample.jpg'
        ])
            ->talents()->create([
                'company_id' => 1,
                'name' => 'talent',
                'email' => 'talent@talent.co.jp',
                'email_verified_at' => now(),
                'password' => 'talent',
                'image_url' => 'public/image/projectImageSample.jpg',
                'remember_token' => Str::random(10),
            ])->projects()->saveMany(Project::factory(3)->make());

        Company::factory(30)
        ->create()
        ->each(function ($company) {
            $company->talents()->saveMany(Talent::factory(random_int(1, 4))->make());
        });
        ;
    }
}
