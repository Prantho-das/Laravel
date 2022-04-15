<?php

namespace Database\Factories;

use App\Models\comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'=>rand(1,5),
            'comments'=>$this->faker->email,
            "comment_img"=>'https://picsum.photos/id/237/200/300',
            'created_at'=>now()
        ];
    }
}
