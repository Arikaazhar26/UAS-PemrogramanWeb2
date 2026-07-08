<?php

namespace Database\Factories;


use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;



class BookFactory extends Factory
{


    public function definition(): array
    {

        return [

            'category_id' => Category::inRandomOrder()->first()->id,


            'title' => fake()->sentence(3),


            'publisher' => fake()->company(),


            'publish_year' => fake()->year(),


            'isbn' => fake()->isbn13(),


            'stock' => fake()->numberBetween(1,20),


            'description' => fake()->paragraph(),


            'cover' => null,


        ];

    }


}