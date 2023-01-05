<?php

namespace App\Http\Controllers;

use App\Precompromiso;
use App\Unidadadministrativa;
use App\Tipodecompromiso;
use App\Beneficiario;
use App\detallesprecompromiso;
use Illuminate\Http\Request;

/**
 * Class PrecompromisoController
 * @package App\Http\Controllers
 */
class PrecompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precompromisos = Precompromiso::where('status', 'EP')->paginate();

        return view('precompromiso.index', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $precompromisos = Precompromiso::where('status', 'PR')->paginate();

        return view('precompromiso.procesadas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $precompromisos = Precompromiso::where('status', 'AN')->paginate();

        return view('precompromiso.anuladas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precompromiso = new Precompromiso();
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');


        return view('precompromiso.create', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso = Precompromiso::create($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precompromiso = Precompromiso::find($id);
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        return view('precompromiso.show', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $precompromiso = Precompromiso::find($id);
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        return view('precompromiso.edit', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Precompromiso $precompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precompromiso $precompromiso)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso->update($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $precompromiso = Precompromiso::find($id)->delete();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso deleted successfully');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $precompromiso = Precompromiso::find($id);

        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['precompromisos' => $id]);

        $detallesprecompromisos = Detallesprecompromiso::paginate();

        return view('precompromiso.agregar', compact('detallesprecompromisos', 'precompromiso'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesprecompromisos->perPage());
    }
}
