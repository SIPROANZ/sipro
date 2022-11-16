<?php

namespace App\Http\Controllers;

use App\Criterio;
use Illuminate\Http\Request;

/**
 * Class CriterioController
 * @package App\Http\Controllers
 */
class CriterioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = Criterio::paginate();

        return view('criterio.index', compact('criterios'))
            ->with('i', (request()->input('page', 1) - 1) * $criterios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $criterio = new Criterio();
        return view('criterio.create', compact('criterio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Criterio::$rules);

        $criterio = Criterio::create($request->all());

        return redirect()->route('criterios.index')
            ->with('success', 'Criterio created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $criterio = Criterio::find($id);

        return view('criterio.show', compact('criterio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $criterio = Criterio::find($id);

        return view('criterio.edit', compact('criterio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Criterio $criterio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criterio $criterio)
    {
        request()->validate(Criterio::$rules);

        $criterio->update($request->all());

        return redirect()->route('criterios.index')
            ->with('success', 'Criterio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $criterio = Criterio::find($id)->delete();

        return redirect()->route('criterios.index')
            ->with('success', 'Criterio deleted successfully');
    }
}
