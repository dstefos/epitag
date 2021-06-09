<?php

namespace Database\Factories;

use App\Models\bundle;
use Illuminate\Database\Eloquent\Factories\Factory;

class BundleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = bundle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Create random card quantity between 3 and 10
        $quantity=rand(3,10);       

        return [
            'title' => "Bundle with ".$quantity." Cards",
            'image' => "bundle.png",
            'quantity' => $quantity,
            'price' => $quantity*1.3,
        ];
    }
}
