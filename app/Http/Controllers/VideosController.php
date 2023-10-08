<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Video::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoRequest $request, Video $video)
    {
        $validated = $request->validated();

        if (isEmpty($request->categoria_id))
        {
            $validated['categoria_id'] = 1;
        }

        return response()->json(
            [
             'dados_cadastro' => $video->create($validated),
             'status' => 'Video cadastrado com sucesso'],
             201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $video = Video::find($id);

         if ($video) {
            return response()->json($video, 200);
        }

        return response()->json(['message' => 'Video not found'], 404);

}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoRequest $request, string $id)
    {
        $video = Video::find($id);

        if ($video) {
           $video->update(['titulo' => $request->titulo ? $request->titulo : $video->titulo,
                           'descricao' => $request->descricao ? $request->descricao : $video->descricao,
                           'url' => $request->url ? $request->url : $video->url,
                           'categoria_id' => $request->categoria_id ? $request->categoria_id : $video->categoria_id
        ]);
            return response()->json(['video' => $video,
                                    'message' => 'Video atualizado com sucesso!']);
        }

        return response()->json(['message' => 'Video não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Video::destroy($id)) {
            return response()->json(['message' => 'Video excluido com sucesso!']);
        }

        return response()->json(['message' => 'Não foi possível excluir o vídeo!'], 404);
    }

    /**
     * Show videos by name
     */
    public function showByTitle(Request $request)
    {
        $searchItem = $request->input('titulo');

        $videos = Video::where('titulo', 'like', '%' . $searchItem . '%')->get();

        if (!count($videos) == 0){
            return $videos;
        }

        return response()->json(['message' => 'Video(s) não encontrado(s)!']);
    }

    public function showQuantityVideos(){
        $videos = Video::count();

        return response()->json(['quantidade_videos' => $videos], 200);
    }

}
