<?php

namespace App\Http\Controllers;

use App\Ajustescompromiso;
use Illuminate\Http\Request;

/**
 * Class AjustescompromisoController
 * @package App\Http\Controllers
 */
class AjustescompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajustescompromisos = Ajustescompromiso::paginate();
        

        return view('ajustescompromiso.index', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ajustescompromiso = new Ajustescompromiso();
        return view('ajustescompromiso.create', compact('ajustescompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ajustescompromiso::$rules);

        $ajustescompromiso = Ajustescompromiso::create($request->all());

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id);

        return view('ajustescompromiso.show', compact('ajustescompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id);

        return view('ajustescompromiso.edit', compact('ajustescompromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ajustescompromiso $ajustescompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajustescompromiso $ajustescompromiso)
    {
        request()->validate(Ajustescompromiso::$rules);

        $ajustescompromiso->update($request->all());

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id)->delete();

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso deleted successfully');
    }
}
