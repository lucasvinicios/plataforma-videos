<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itensPorPagina = 5;

        $pagina = $request->query('page', 1);

        $categorias = Categoria::paginate($itensPorPagina, ['*'], 'page', $pagina);

        $numeroDePaginas = $categorias->lastPage();

        if ($numeroDePaginas < $pagina)
        {
            return response()->json(['message' => 'O total de itens não corresponde a página que você procura!']);
        }

        return response()->json(['data' => $categorias,
        'message' => 'Success!'
   ]);
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
    public function store(CategoriaRequest $request)
    {
        $data = Categoria::create([
            'titulo' => $request->titulo,
            'cor' => $request->cor
        ]);

        if ($data){
            return response()->json(
                ['data' => $data,
                 'message' => 'Categoria criada!'
            ], 201
            );
        }

        return response()->json(['message' => 'Não foi possível criar a categoria']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Categoria::find($id);

            if ($data){
                return response()->json([
                    'data' => $data
                ]);
            }
            return response()->json(['message' => 'Categoria não encontrada!'], 404);

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
    public function update(CategoriaRequest $request, string $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria){
            $categoria->update([
                'titulo' => $request->titulo,
                'cor' => $request->cor
            ]);

            return response()->json([
                'categoria' => $categoria,
                'message' => 'Categoria atualizada com sucesso!'
            ]);
        }

        return response()->json([
            'message' => 'Categoria não encontrada!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

        if($categoria)
        {
            Categoria::destroy($id);

            return response()->json(
                ['categoria' => $categoria,
                 'message' => 'Categoria deletada com sucesso!'
                ]
            );
        }

        return response()->json(
            ['message' => 'Categoria não encontrada!']
        , 404);
    }

    /**
     * Show the videos to specify category
     */
    public function showVideosToCategory(string $id, Video $video)
    {
        $categoria = Categoria::find($id);

        if ($categoria)
        {
            $videos = Video::where('categoria_id', $categoria->id)->get();

            $qty = count($videos);

            return response()->json([
                'videos' => $videos,
                'message' => "Foram encontrados {$qty} videos na categoria '{$categoria->titulo}'."
            ]);
        }

        return response()->json([
            'message' => 'Categoria não encontrada!'
        ]);
    }
}
