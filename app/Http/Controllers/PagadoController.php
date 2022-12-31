<?php

namespace App\Http\Controllers;

use App\Pagado;
use Illuminate\Http\Request;

/**
 * Class PagadoController
 * @package App\Http\Controllers
 */
class PagadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagados = Pagado::paginate();

        return view('pagado.index', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagado = new Pagado();
        return view('pagado.create', compact('pagado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pagado::$rules);

        $pagado = Pagado::create($request->all());

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagado = Pagado::find($id);

        return view('pagado.show', compact('pagado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagado = Pagado::find($id);

        return view('pagado.edit', compact('pagado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pagado $pagado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagado $pagado)
    {
        request()->validate(Pagado::$rules);

        $pagado->update($request->all());

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pagado = Pagado::find($id)->delete();

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado deleted successfully');
    }
}
