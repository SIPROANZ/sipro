<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Analisi;
use App\Detallesanalisi;
use Illuminate\Http\Request;

/**
 * Class CompraController
 * @package App\Http\Controllers
 */
class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::where('status', 'EP')->paginate();
        
        return view('compra.index', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanalisis()
    {
       // $compras = Compra::paginate();
        $analisis = Analisi::where('estatus', 'PR')->paginate();

       

        return view('compra.analisis', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compra = new Compra();
        return view('compra.create', compact('compra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Compra::$rules);

        $compra = Compra::create($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compra = Compra::find($id);

        return view('compra.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compra = Compra::find($id);

        return view('compra.edit', compact('compra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Compra $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        request()->validate(Compra::$rules);

        $compra->update($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compra = Compra::find($id)->delete();

        return redirect()->route('compras.index')
            ->with('success', 'Compra deleted successfully');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarcompra($id)
    {
        $analisis_id = $id;
        $compra = new Compra();
        $total_base = 0;
        $total_iva = 0;
        $total = 0;
       
        $detalles_analisis = Detallesanalisi::where('analisis_id', $analisis_id)->get();

        foreach($detalles_analisis as $row){
            $total_base += $row->subtotal;
            $total_iva += $row->iva;
        }
        
        $total = $total_base + $total_iva;

        return view('compra.agregarcompra', compact('compra', 'analisis_id', 'total_base', 'total_iva', 'total'));
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $compra = Compra::find($id);
        $compra->status = 'PR';
        $compra->save();

        $aprobado = 0;

        //Chequear disponibilidad en las partidas.
        



        if($aprobado == 1){
            return redirect()->route('compras.index')
            ->with('success', 'Compra Aprobada Exitosamente.');
        }else{
            return redirect()->route('compras.index')
            ->with('success', 'No Aprobado.');
        }





      

       
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $compras = Compra::where('status', 'PR')->paginate();

        return view('compra.procesadas', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $compras = Compra::where('status', 'AN')->paginate();

        return view('compra.anuladas', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $compra = Compra::find($id);
        $compra->status = 'AN';
        $compra->save();

        return redirect()->route('compras.index')
            ->with('success', 'Compra Anulada exitosamente.');

            
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function reversar($id)
    {
        $analisi = Analisi::find($id);
        $analisi->estatus = 'EP';
        $analisi->save();

        return redirect()->route('compras.index')
            ->with('success', 'Analisis de Cotizacion Reversada exitosamente.');
    }
}
