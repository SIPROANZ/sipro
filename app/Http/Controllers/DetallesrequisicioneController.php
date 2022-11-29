<?php

namespace App\Http\Controllers;

use App\Detallesrequisicione;
use App\Requisicione;
use App\Bo;
use Illuminate\Http\Request;

/**
 * Class DetallesrequisicioneController
 * @package App\Http\Controllers
 */
class DetallesrequisicioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesrequisiciones = Detallesrequisicione::paginate();

        return view('detallesrequisicione.index', compact('detallesrequisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesrequisiciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesrequisicione = new Detallesrequisicione();

        $bos = Bo::pluck('descripcion', 'id');

        $requisiciones = Requisicione::pluck('concepto', 'id');

        return view('detallesrequisicione.create', compact('detallesrequisicione', 'bos', 'requisiciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesrequisicione::$rules);

        $detallesrequisicione = Detallesrequisicione::create($request->all());

        return redirect()->route('detallesrequisiciones.index')
            ->with('success', 'Detallesrequisicione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesrequisicione = Detallesrequisicione::find($id);

        return view('detallesrequisicione.show', compact('detallesrequisicione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesrequisicione = Detallesrequisicione::find($id);

        $bos = Bo::pluck('descripcion', 'id');

        $requisiciones = Requisicione::pluck('concepto', 'id');

        return view('detallesrequisicione.edit', compact('detallesrequisicione' , 'bos', 'requisiciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesrequisicione $detallesrequisicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesrequisicione $detallesrequisicione)
    {
        request()->validate(Detallesrequisicione::$rules);

        $detallesrequisicione->update($request->all());

        return redirect()->route('detallesrequisiciones.index')
            ->with('success', 'Detallesrequisicione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesrequisicione = Detallesrequisicione::find($id)->delete();

        return redirect()->route('detallesrequisiciones.index')
            ->with('success', 'Detallesrequisicione deleted successfully');
    }
}
