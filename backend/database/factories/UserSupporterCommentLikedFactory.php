<?php

namespace Database\Factories;

use App\Models\UserSupporterCommentLiked;
use App\Models\SupporterComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSupporterCommentLikedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSupporterCommentLiked::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supporter_comment_id' => random_int(1,300),
            'user_id' => random_int(1, 100)
        ];
    }
}
