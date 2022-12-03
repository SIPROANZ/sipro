<?php

namespace App\Http\Controllers;

use App\Unidadadministrativa;
use App\Ejercicio;
use Illuminate\Http\Request;

/**
 * Class UnidadadministrativaController
 * @package App\Http\Controllers
 */
class UnidadadministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadadministrativas = Unidadadministrativa::paginate();

        return view('unidadadministrativa.index', compact('unidadadministrativas'))
            ->with('i', (request()->input('page', 1) - 1) * $unidadadministrativas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidadadministrativa = new Unidadadministrativa();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        return view('unidadadministrativa.create', compact('unidadadministrativa' , 'ejercicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Unidadadministrativa::$rules);

        $unidadadministrativa = Unidadadministrativa::create($request->all());

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id);

        return view('unidadadministrativa.show', compact('unidadadministrativa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id);

        return view('unidadadministrativa.edit', compact('unidadadministrativa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Unidadadministrativa $unidadadministrativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidadadministrativa $unidadadministrativa)
    {
        request()->validate(Unidadadministrativa::$rules);

        $unidadadministrativa->update($request->all());

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa actualilzada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id)->delete();

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa eliminada con éxito');
    }
}
