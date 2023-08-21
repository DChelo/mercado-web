<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
	protected $model = Product::class;

	public function definition()
	{
		return [
			'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
			'name' => fake()->name(),
			'price' => fake()->numberBetween($min = 1000, $max = 100000),
			'description' => fake()->paragraph(),
			'stock' => fake()->randomDigit(),
			'color' => fake()->colorName(),
		];
	}

	public function configure()
	{
		return $this->afterCreating(function (Product $book) {
			$file = new File(['route' => '/storage/images/products/default.png']);
			$book->file()->save($file);
		});
	}
}
