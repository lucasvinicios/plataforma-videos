<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{

    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->word(),
            'cor' => fake()->colorName()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($categoria) {
            return [
                'categoria_id' => $categoria->id,
            ];
        });
    }
}
