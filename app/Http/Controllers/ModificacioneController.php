<?php

namespace App\Http\Controllers;

use App\Modificacione;
use Illuminate\Http\Request;

/**
 * Class ModificacioneController
 * @package App\Http\Controllers
 */
class ModificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modificaciones = Modificacione::paginate();

        return view('modificacione.index', compact('modificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $modificaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modificacione = new Modificacione();
        return view('modificacione.create', compact('modificacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Modificacione::$rules);

        $modificacione = Modificacione::create($request->all());

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modificacione = Modificacione::find($id);

        return view('modificacione.show', compact('modificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modificacione = Modificacione::find($id);

        return view('modificacione.edit', compact('modificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modificacione $modificacione)
    {
        request()->validate(Modificacione::$rules);

        $modificacione->update($request->all());

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modificacione = Modificacione::find($id)->delete();

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione deleted successfully');
    }
}
