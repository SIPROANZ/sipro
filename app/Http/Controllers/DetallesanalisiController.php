<?php

namespace App\Http\Controllers;

use App\Detallesanalisi;
use App\Proveedore;
use App\Analisi;
use App\Bo;
use Illuminate\Http\Request;

/**
 * Class DetallesanalisiController
 * @package App\Http\Controllers
 */
class DetallesanalisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesanalisis = Detallesanalisi::paginate();

        return view('detallesanalisi.index', compact('detallesanalisis'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesanalisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesanalisi = new Detallesanalisi();
        $proveedores = Proveedore::pluck('nombre','id');
        $analisis = Analisi::pluck('numeracion','id');
        $bos = Bo::pluck('descripcion', 'id');
        return view('detallesanalisi.create', compact('detallesanalisi', 'proveedores','analisis', 'bos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesanalisi::$rules);

        $detallesanalisi = Detallesanalisi::create($request->all());

        return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesanalisi = Detallesanalisi::find($id);

        return view('detallesanalisi.show', compact('detallesanalisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesanalisi = Detallesanalisi::find($id);
        
        $proveedores = Proveedore::pluck('nombre','id');
        $analisis = Analisi::pluck('numeracion','id');
        $bos = Bo::pluck('descripcion', 'id');

        return view('detallesanalisi.edit', compact('detallesanalisi', 'proveedores','analisis', 'bos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesanalisi $detallesanalisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesanalisi $detallesanalisi)
    {
        request()->validate(Detallesanalisi::$rules);

        $detallesanalisi->update($request->all());

        return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesanalisi = Detallesanalisi::find($id)->delete();

        return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi deleted successfully');
    }
}
