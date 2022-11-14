<?php

namespace App\Http\Controllers;

use App\Tipodecompromiso;
use Illuminate\Http\Request;

/**
 * Class TipodecompromisoController
 * @package App\Http\Controllers
 */
class TipodecompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipodecompromisos = Tipodecompromiso::paginate();

        return view('tipodecompromiso.index', compact('tipodecompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipodecompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipodecompromiso = new Tipodecompromiso();
        return view('tipodecompromiso.create', compact('tipodecompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipodecompromiso::$rules);

        $tipodecompromiso = Tipodecompromiso::create($request->all());

        return redirect()->route('tipodecompromisos.index')
            ->with('success', 'Tipodecompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipodecompromiso = Tipodecompromiso::find($id);

        return view('tipodecompromiso.show', compact('tipodecompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipodecompromiso = Tipodecompromiso::find($id);

        return view('tipodecompromiso.edit', compact('tipodecompromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipodecompromiso $tipodecompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipodecompromiso $tipodecompromiso)
    {
        request()->validate(Tipodecompromiso::$rules);

        $tipodecompromiso->update($request->all());

        return redirect()->route('tipodecompromisos.index')
            ->with('success', 'Tipodecompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipodecompromiso = Tipodecompromiso::find($id)->delete();

        return redirect()->route('tipodecompromisos.index')
            ->with('success', 'Tipodecompromiso deleted successfully');
    }
}
