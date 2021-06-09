<?php

namespace Database\Factories;

use App\Models\card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->name(),
            'image' => "card.png",
            'price' => 0,
            'sellable' => false,
            'user_id' => null,
        ];
    }
}
