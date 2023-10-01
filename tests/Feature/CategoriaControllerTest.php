<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function testIndexRetornaListaDeCategorias()
    {

        Categoria::factory()->count(3)->create();

        $response = $this->get('/api/categorias');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                'id',
                'titulo',
                'cor'
                ]
            ]
        ]);
    }

    public function testStoreRetornaCategoriaCriada()
    {
        $categoria = [
            'titulo' => $this->faker->word,
            'cor' => $this->faker->hexColor
        ];

        $response = $this->post('/api/categorias', $categoria);

        $response->assertCreated(201);
    }

    public function testShowRetornaCategoriaAtravesId()
    {
        $categoria = Categoria::factory()->create([
            'id' => $this->faker->randomDigit,
            'titulo' => $this->faker->text,
            'cor' => $this->faker->hexColor
        ]);

        $response = $this->get("/api/categorias/" . $categoria->id);

        $response->assertStatus(200);
    }

    public function testUpdateAtualizaCategoriaEspecifica()
    {
        $categoria = Categoria::factory()->create([
            'id' => $this->faker->randomDigit,
            'titulo' => $this->faker->word,
            'cor' => $this->faker->hexColor
        ]);

        $novosDadosCategoria = [
            'titulo' => $this->faker->word,
            'cor' => $this->faker->hexColor
        ];

        $response = $this->put('/api/categorias/' . $categoria->id, $novosDadosCategoria);

        $response->assertStatus(200);
    }

    public function testDestroyExcluiCategoriaEspecifica()
    {

        $categoria = Categoria::factory()->create([
            'id' => $this->faker->randomDigit,
            'titulo' => $this->faker->word(12),
            'cor' => $this->faker->hexColor
        ]);

        $response = $this->delete('/api/categorias/' . $categoria->id);

        $response->assertStatus(200);
    }

    public function testShowVideosToCategoryRetornaVideoDaCategoria()
    {
        $categoria = Categoria::factory()->create();

        $videos = Video::factory()->count(3)->create([
            'categoria_id' => $categoria->id
            ]);

        $response = $this->get('/api/categorias/' . $categoria->id . '/videos');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'videos' => [
                '*' => [
                    'id',
                    'titulo',
                    'descricao',
                    'url',
                ],
            ],
        ]);
    }
}
