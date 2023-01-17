<?php

namespace App\Http\Controllers;

use App\Transferencia;
use App\Banco;
use App\Pagado;
use App\ordenpago;
use App\Cuentasbancaria;
use App\Beneficiario;
use App\Detallepagado;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

/**
 * Class TransferenciaController
 * @package App\Http\Controllers
 */
class TransferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transferencias = Transferencia::paginate();

        return view('transferencia.index', compact('transferencias'))
            ->with('i', (request()->input('page', 1) - 1) * $transferencias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transferencia = new Transferencia();
        return view('transferencia.create', compact('transferencia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        request()->validate(Transferencia::$rules);

        $max_correlativo = DB::table('transferencias')->max('egreso');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['egreso'=>$numero_correlativo]);
        $request->merge(['status'=>'EP']);

        $transferencia = Transferencia::create($request->all());

        //Inicio de codigo aumento pagado

        $pagados =Pagado::find($request->pagado_id);
        $pagado->increment('montopagado', $request->montotransferencia );

       


        return redirect()->route('transferencias.index')
            ->with('success', 'Transferencia created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transferencia = Transferencia::find($id);

        return view('transferencia.show', compact('transferencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transferencia = Transferencia::find($id);

        return view('transferencia.edit', compact('transferencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Transferencia $transferencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transferencia $transferencia)
    {
        request()->validate(Transferencia::$rules);

        $transferencia->update($request->all());

        return redirect()->route('transferencias.index')
            ->with('success', 'Transferencia updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $transferencia = Transferencia::find($id)->delete();

        return redirect()->route('transferencias.index')
            ->with('success', 'Transferencia deleted successfully');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar()
    {
        $transferencia = Transferencia::where('status', 'PR')->paginate();

        
        return view('transferencia.agregar', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $transferencias->perPage());
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregartransferencia($id)
    {
        $pagado_id = $id;
        $transferencia = new Transferencia();

       $pagados = Pagado::find($pagado_id);
       $cuentasbancarias = Cuentasbancaria::pluck('cuenta', 'id');

       return view('pagado.agregartransferencia', compact('transferencia','pagados','cuentasbancarias'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function miagregar()
    {
        $pagados = Pagado::where('status', 'PR')->paginate();

        return view('transferencia.miagregar', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
    }

         /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function seleccionarpagado($id)
    {
        $pagado_id = $id;
        $pagados = Pagado::find($id);

        $cuentasbancarias =Cuentasbancaria::pluck('cuenta', 'id');
        $bancos =Banco::pluck('denominacion', 'id');
        $ordenpagos =Ordenpago::pluck('montoneto', 'id');
        
        $transferencia = new Transferencia();
        return view('transferencia.create', compact('transferencia','pagados', 'cuentasbancarias', 'bancos', 'ordenpagos'));
    }
}
