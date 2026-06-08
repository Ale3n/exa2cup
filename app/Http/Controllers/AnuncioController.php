<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Bitacora;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.anuncios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'rol_destino' => 'required|string|in:Postulante,ESTUDIANTE',
        ]);

        $anuncio = Anuncio::create([
            'titulo' => $data['titulo'],
            'mensaje' => $data['mensaje'],
            'rol_destino' => $data['rol_destino'],
            'activo' => true,
        ]);



        Bitacora::create([
            'usuario' => auth()->user()->name ?? auth()->user()->email,
            'accion' => "Creó anuncio #{$anuncio->id} ({$anuncio->titulo})",
            'hora' => now(),
        ]);

        return redirect()
            ->route('anuncios.create')
            ->with('success', 'Anuncio creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function marcarLeido(Request $request)
    {
        auth()->user()
            ->anuncios()
            ->syncWithoutDetaching([
                $request->anuncio_id
            ]);

        return response()->json([
            'success' => true
        ]);
    }
}
