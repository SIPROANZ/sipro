<?php

namespace App\Http\Controllers;

use App\Detallesmodificacione;
use Illuminate\Http\Request;

/**
 * Class DetallesmodificacioneController
 * @package App\Http\Controllers
 */
class DetallesmodificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesmodificaciones = Detallesmodificacione::paginate();

        return view('detallesmodificacione.index', compact('detallesmodificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesmodificaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesmodificacione = new Detallesmodificacione();
        return view('detallesmodificacione.create', compact('detallesmodificacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesmodificacione::$rules);

        $detallesmodificacione = Detallesmodificacione::create($request->all());

        return redirect()->route('detallesmodificaciones.index')
            ->with('success', 'Detallesmodificacione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesmodificacione = Detallesmodificacione::find($id);

        return view('detallesmodificacione.show', compact('detallesmodificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesmodificacione = Detallesmodificacione::find($id);

        return view('detallesmodificacione.edit', compact('detallesmodificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesmodificacione $detallesmodificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesmodificacione $detallesmodificacione)
    {
        request()->validate(Detallesmodificacione::$rules);

        $detallesmodificacione->update($request->all());

        return redirect()->route('detallesmodificaciones.index')
            ->with('success', 'Detallesmodificacione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesmodificacione = Detallesmodificacione::find($id)->delete();

        return redirect()->route('detallesmodificaciones.index')
            ->with('success', 'Detallesmodificacione deleted successfully');
    }
}
