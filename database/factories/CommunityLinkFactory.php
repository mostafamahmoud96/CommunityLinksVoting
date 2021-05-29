<?php

namespace Database\Factories;

use App\Models\CommunityLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class CommunityLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommunityLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>\App\Models\User::factory(),
            'channel_id'=>1,
            'title' => $this->faker->sentence,
            'link'=>$this->faker->url,
            'approved'=>0
        ];
    }
}
