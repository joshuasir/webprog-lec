<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            //
            'id' => Item::generateItemId(),
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(10000, 100000),
            'image' => 'http://atlas-content-cdn.pixelsquid.com/stock-images/recycled-paper-bag-gift-0M3NZR8-600.jpg',
            'category' => ['Food','Beverage','Dessert'][rand(0,2)],
            'description' => $this->faker->sentence(rand(5, 8))
        ];
    }
}
