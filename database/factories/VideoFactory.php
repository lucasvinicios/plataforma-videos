<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoria = Categoria::inRandomOrder()->first();

        return [
            'titulo' => fake()->title(),
            'categoria_id' => $categoria->id,
            'descricao' => fake()->sentence(),
            'url' => fake()->url(),
        ];
    }
}
