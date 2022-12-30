<?php

namespace App\Http\Controllers;

use App\Detalleretencione;
use Illuminate\Http\Request;

/**
 * Class DetalleretencioneController
 * @package App\Http\Controllers
 */
class DetalleretencioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleretenciones = Detalleretencione::paginate();

        return view('detalleretencione.index', compact('detalleretenciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleretenciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleretencione = new Detalleretencione();
        return view('detalleretencione.create', compact('detalleretencione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detalleretencione::$rules);

        $detalleretencione = Detalleretencione::create($request->all());

        return redirect()->route('detalleretenciones.index')
            ->with('success', 'Detalleretencione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleretencione = Detalleretencione::find($id);

        return view('detalleretencione.show', compact('detalleretencione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleretencione = Detalleretencione::find($id);

        return view('detalleretencione.edit', compact('detalleretencione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detalleretencione $detalleretencione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalleretencione $detalleretencione)
    {
        request()->validate(Detalleretencione::$rules);

        $detalleretencione->update($request->all());

        return redirect()->route('detalleretenciones.index')
            ->with('success', 'Detalleretencione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleretencione = Detalleretencione::find($id)->delete();

        return redirect()->route('detalleretenciones.index')
            ->with('success', 'Detalleretencione deleted successfully');
    }
}
