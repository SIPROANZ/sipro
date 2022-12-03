<?php

namespace App\Http\Controllers;

use App\Ejecucione;
use App\Ejercicio;
use App\Unidadadministrativa;
use App\Meta;
use App\Financiamiento;
use App\Poa;
use Illuminate\Http\Request;


/**
 * Class EjecucioneController
 * @package App\Http\Controllers
 */
class EjecucioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejecuciones = Ejecucione::paginate();

        return view('ejecucione.index', compact('ejecuciones'))
            ->with('i', (request()->input('page', 1) - 1) * $ejecuciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ejecucione = new Ejecucione();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $unidadadministrativa = Unidadadministrativa::pluck('sector' , 'id'); 
        $meta = Meta::pluck('meta' , 'id'); 
        $financiamiento = Financiamiento::pluck('nombre', 'id'); 
        $poa = Poa::pluck('proyecto', 'id');

        return view('ejecucione.create', compact('ejecucione' , 'ejercicio' , 'unidadadministrativa' , 'meta' , 'financiamiento' , 'poa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ejecucione::$rules);

        $ejecucione = Ejecucione::create($request->all());

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejecucione = Ejecucione::find($id);

        return view('ejecucione.show', compact('ejecucione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ejecucione = Ejecucione::find($id);

        return view('ejecucione.edit', compact('ejecucione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ejecucione $ejecucione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejecucione $ejecucione)
    {
        request()->validate(Ejecucione::$rules);

        $ejecucione->update($request->all());

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución actualizada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ejecucione = Ejecucione::find($id)->delete();

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución eliminada con éxito');
    }
}
