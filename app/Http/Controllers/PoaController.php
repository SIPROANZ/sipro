<?php

namespace App\Http\Controllers;

use App\Poa;
use App\Ejercicio;
use App\Institucione;
use App\Objetivoshistorico;
use App\Objetivonacionale;
use App\Objetivosestrategico;
use App\Objetivogenerale;
use App\Objetivomunicipale;
use App\Objetivopei;
use App\Unidadadministrativa;
use Illuminate\Http\Request;

/**
 * Class PoaController
 * @package App\Http\Controllers
 */
class PoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poas = Poa::paginate();

        return view('poa.index', compact('poas'))
            ->with('i', (request()->input('page', 1) - 1) * $poas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poa = new Poa();
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $objetivoshistoricos= Objetivoshistorico::pluck('objetivo', 'id');
        $objetivonacionales= Objetivonacionale::pluck('objetivo', 'id');
        $objetivosestrategicos= Objetivosestrategico::pluck('objetivo', 'id');
        $objetivogenerales= Objetivogenerale::pluck('objetivo', 'id');
        $objetivomunicipales= Objetivomunicipale::pluck('objetivo', 'id');
        $objetivopeis= Objetivopei::pluck('objetivo', 'id');
        $unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

        return view('poa.create', compact('poa', 'ejercicios', 'instituciones', 'objetivoshistoricos', 'objetivonacionales', 'objetivosestrategicos', 'objetivogenerales', 'objetivomunicipales','objetivopeis', 'unidadadministrativas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Poa::$rules);

        $poa = Poa::create($request->all());

        return redirect()->route('poas.index')
            ->with('success', 'Plan operativo anual creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poa = Poa::find($id);

        return view('poa.show', compact('poa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poa = Poa::find($id);
       
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $objetivoshistoricos= Objetivoshistorico::pluck('objetivo', 'id');
        $objetivonacionales= Objetivonacionale::pluck('objetivo', 'id');
        $objetivosestrategicos= Objetivosestrategico::pluck('objetivo', 'id');
        $objetivogenerales= Objetivogenerale::pluck('objetivo', 'id');
        $objetivomunicipales= Objetivomunicipale::pluck('objetivo', 'id');
        $objetivopeis= Objetivopei::pluck('objetivo', 'id');
        $unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

        return view('poa.edit', compact('poa', 'ejercicios', 'instituciones', 'objetivoshistoricos', 'objetivonacionales', 'objetivosestrategicos', 'objetivogenerales', 'objetivomunicipales','objetivopeis', 'unidadadministrativas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Poa $poa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poa $poa)
    {
        request()->validate(Poa::$rules);

        $poa->update($request->all());

        return redirect()->route('poas.index')
            ->with('success', 'Plan operativo anual actualizado exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $poa = Poa::find($id)->delete();

        return redirect()->route('poas.index')
            ->with('success', 'Plan operativo anual eliminado exitosamente.');
    }
}
