<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:22 PM
 */

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'author_id' => rand(1, 20),
            'image_url' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug(),
            'title' => $this->faker->title(),
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomDigit(),
            'status' => rand(1, 4),
            'priority' => rand(1, 20),
            'created_by' => rand(1, 10),
            'updated_by' => rand(1, 10),
            'created_at' => $this->faker->dateTime()
        ];
    }
}
