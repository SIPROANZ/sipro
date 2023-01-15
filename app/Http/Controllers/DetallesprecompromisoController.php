<?php

namespace App\Http\Controllers;

use App\Detallesprecompromiso;
use App\Precompromiso;
use App\Unidadadministrativa;
use App\Ejecucione;
use Illuminate\Http\Request;

/**
 * Class DetallesprecompromisoController
 * @package App\Http\Controllers
 */
class DetallesprecompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesprecompromisos = Detallesprecompromiso::paginate();

        return view('detallesprecompromiso.index', compact('detallesprecompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesprecompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesprecompromiso = new Detallesprecompromiso();
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $precompromisos = Precompromiso::pluck('concepto', 'id');
        $ejecuciones = Ejecucione::pluck ('clasificadorpresupuestario', 'id');
        $unidades = Unidadadministrativa::all();

        return view('detallesprecompromiso.create', compact('unidades', 'detallesprecompromiso', 'unidadadministrativas', 'precompromisos', 'ejecuciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesprecompromiso::$rules);
        
        //Obtener el id de la requisicion
        $precompromiso_id = session('precompromisos');
        //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
        $request->merge(['precompromiso_id'  => $precompromiso_id]);

        $detallesprecompromiso = Detallesprecompromiso::create($request->all());

      /*  return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso created successfully.');

*/
            //Agregar el total a la tabla principal
            $precompromiso = Precompromiso::find($precompromiso_id);

        $detallesprecompromiso = Detallesprecompromiso::where('precompromiso_id', $precompromiso_id)->get();
        $suma = $detallesprecompromiso->sum('montocompromiso');
        $precompromiso->montototal = $suma;
        $precompromiso->save();


            if(session()->has('precompromisos')){
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro agregado satisfactoriamente.');
            }else{
                return redirect()->route('precompromisos.index')
                ->with('success', 'Registro Actualizado Exitosamente.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesprecompromiso = Detallesprecompromiso::find($id);

        return view('detallesprecompromiso.show', compact('detallesprecompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesprecompromiso = Detallesprecompromiso::find($id);
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $precompromisos = Precompromiso::pluck('concepto', 'id');
        $ejecuciones = Ejecucione::pluck ('clasificadorpresupuestario', 'id');
        $unidades = Unidadadministrativa::all();

        return view('detallesprecompromiso.edit', compact('unidades','detallesprecompromiso', 'unidadadministrativas', 'precompromisos', 'ejecuciones' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesprecompromiso $detallesprecompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesprecompromiso $detallesprecompromiso)
    {
        request()->validate(Detallesprecompromiso::$rules);
        //Obtener el id de la requisicion
        $precompromiso_id = session('precompromisos');
        //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
        $request->merge(['precompromiso_id'  => $precompromiso_id]);
        $detallesprecompromiso->update($request->all());
             /*
        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso updated successfully');
              */
           
              //Agregar el total a la tabla principal
            $precompromiso = Precompromiso::find($precompromiso_id);

            $detallesprecompromiso = Detallesprecompromiso::where('precompromiso_id', $precompromiso_id)->get();
            $suma = $detallesprecompromiso->sum('montocompromiso');
            $precompromiso->montototal = $suma;
            $precompromiso->save();
              
            if(session()->has('precompromisos')){
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro agregado satisfactoriamente.');
            }else{
                return redirect()->route('precompromisos.index')
                ->with('success', 'Registro Actualizado Exitosamente.');
            }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesprecompromiso = Detallesprecompromiso::find($id)->delete();
           /*
        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso deleted successfully');
            */
            $precompromiso_id = session('precompromisos');
            if(session()->has('precompromisos')){
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro agregado satisfactoriamente.');
            }else{
                return redirect()->route('precompromisos.index')
                ->with('success', 'Registro Actualizado Exitosamente.');
            }
    }

    //para llenar un select dinamico
    public function ejecucionpre(Request $request){
        if(isset($request->texto)){
            $ejecuc = Ejecucione::where('unidadadministrativa_id', $request->texto)->get();
            return response()->json(
                [
                    'lista' => $ejecuc,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }
}
