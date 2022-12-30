<?php

namespace App\Http\Controllers;

use App\Detallesprecompromiso;
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
        return view('detallesprecompromiso.create', compact('detallesprecompromiso'));
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

        $detallesprecompromiso = Detallesprecompromiso::create($request->all());

        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso created successfully.');
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

        return view('detallesprecompromiso.edit', compact('detallesprecompromiso'));
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

        $detallesprecompromiso->update($request->all());

        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesprecompromiso = Detallesprecompromiso::find($id)->delete();

        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso deleted successfully');
    }
}
