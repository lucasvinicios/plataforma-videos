<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function test_categoria_poderia_pode_ter_videos(): void
    {
        $categoria = Categoria::factory()->create([
            'titulo' => 'Categoria de Teste',
            'cor' => '#FF0000'
        ]);

        $video = Video::factory()->create([
            'titulo' => 'Video de teste',
            'categoria_id' => $categoria->id
        ]);

        $videos = $categoria->videos;
        $this->assertTrue($videos->contains($video));
    }
}
