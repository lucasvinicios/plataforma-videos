<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideosControllerTest extends TestCase
{

    use WithFaker;

    public function testIndexVideos()
    {
        $videos = Video::factory()->count(3)->create();

        $response = $this->get('/api/videos');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
            'id',
            'titulo',
            'descricao',
            'url',
        ]]);
    }

    public function testStoreVideos()
    {
        $dadosVideo = [
            'titulo' => 'TesteTitulo',
            'descricao' => $this->faker->text(20),
            'url' => $this->faker->url,
            'categoria_id' => $this->faker->randomDigit
        ];

        $response = $this->post('/api/videos', $dadosVideo);

        $response->assertStatus(201);
    }

    public function testShowVideo()
    {
        $video = Video::factory()->create([
            'titulo' => 'TesteTitulo',
            'descricao' => 'TesteDescricao',
            'url' => $this->faker->url,
            'categoria_id' => $this->faker->randomDigit
        ]);

        $response = $this->get('/api/videos/' . $video->id);

        $response->assertStatus(200);
    }

    public function testUpdateAtualizaVideoPorId()
    {
        $video = Video::factory()->create([
            'titulo' => 'TesteTitulo',
            'descricao' => 'TesteDescricao',
            'url' => $this->faker->url,
            'categoria_id' => $this->faker->randomDigit
        ]);

        $dadosAtualizados = [
            'titulo' => 'TesteTitulo',
            'descricao' => 'TesteDescricao',
            'url' => $this->faker->url,
            'categoria_id' => $this->faker->randomDigit
        ];

        $response = $this->put('/api/videos/' . $video->id, $dadosAtualizados);

        $response->assertStatus(200);
    }

    public function testDestroyExcluiVideoPorId()
    {
        $video = Video::factory()->create([
            'titulo' => 'TesteTitulo',
            'descricao' => 'TesteDescricao',
            'url' => $this->faker->url,
            'categoria_id' => $this->faker->randomDigit
        ]);

        $response = $this->delete('/api/videos/' . $video->id);

        $response->assertStatus(200);
    }

    public function testShowByTitle()
    {
        $video = Video::factory()->create([
            'titulo' => 'TesteTitulo',
            'descricao' => 'TesteDescricao',
            'url' => $this->faker->url,
            'categoria_id' => $this->faker->randomDigit
        ]);

        $response = $this->get('/api/videos/?search=' . $video->titulo);

        $response->assertStatus(200);
    }
}
