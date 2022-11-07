<?php

namespace App\Http\Controllers;

use App\Requisicione;
use App\Ejercicio;
use App\Institucion;
use App\Unidadadministrativa;
use App\Tipossgp;
use Illuminate\Http\Request;

/**
 * Class RequisicioneController
 * @package App\Http\Controllers
 */
class RequisicioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisiciones = Requisicione::paginate();

        return view('requisicione.index', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requisicione = new Requisicione();

      //  $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');

     //   return view('requisicione.create', compact('requisicione' , 'ejercicios' ));

     /*
        $instituciones = Institucione::pluck('institucion', 'id');

        return view('requisicione.create', compact('requisicione' , 'instituciones' )); 

        $unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

        return view('requisicione.create', compact('requisicione' , 'unidadadministrativas' )); 
        */

        $tipossgps = Tipossgp::pluck('denominacion' , 'id');

        return view('requisicione.create', compact('requisicione' , 'tipossgps' )); 

     //   return view('requisicione.create', compact('requisicione'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Requisicione::$rules);

        $requisicione = Requisicione::create($request->all());

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisicione = Requisicione::find($id);

        return view('requisicione.show', compact('requisicione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisicione = Requisicione::find($id);

       // $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');

      //  return view('requisicione.edit', compact('requisicione' , 'ejercicios' ));

      /*  $instituciones = Institucione::pluck('institucion', 'id');

        return view('requisicione.edit', compact('requisicione' , 'instituciones' )); 

        $unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

        return view('requisicione.edit', compact('requisicione' , 'unidadadministrativas' )); 
        */

        $tipossgps = Tipossgp::pluck('denominacion', 'id');

        return view('requisicione.edit', compact('requisicione' , 'tipossgps' )); 

      //  return view('requisicione.create', compact('requisicione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Requisicione $requisicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisicione $requisicione)
    {
        request()->validate(Requisicione::$rules);

        $requisicione->update($request->all());

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $requisicione = Requisicione::find($id)->delete();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione deleted successfully');
    }
}
