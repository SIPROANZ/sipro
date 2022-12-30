<?php

namespace App\Http\Controllers;

use App\Transferencia;
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

        $transferencia = Transferencia::create($request->all());

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
}
