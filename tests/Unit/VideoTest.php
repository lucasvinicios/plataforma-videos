<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Models\Video;
use Tests\TestCase;

class VideoTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testCriacaoVideo(): void
    {
        $video = Video::factory()->create([
            'titulo' => 'Vídeo de Teste',
            'descricao' => 'Descricao do Video',
            'url' => 'https://exemplo.com/video',
        ]);

        $this->assertEquals('Vídeo de Teste', $video->titulo);
        $this->assertEquals('Descricao do Video', $video->descricao);
        $this->assertEquals('https://exemplo.com/video', $video->url);
    }

    public function testRelacionamentoCategoria()
    {
        $categoria = Categoria::factory()->create();

        $video = Video::factory()->create([
            'categoria_id' => $categoria->id
        ]);

        $this->assertInstanceOf(Categoria::class, $video->categoria);
        $this->assertEquals($categoria->id, $video->categoria->id);
    }
}
