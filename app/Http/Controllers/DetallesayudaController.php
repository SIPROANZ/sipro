<?php

namespace App\Http\Controllers;

use App\Detallesayuda;
use Illuminate\Http\Request;

/**
 * Class DetallesayudaController
 * @package App\Http\Controllers
 */
class DetallesayudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesayudas = Detallesayuda::paginate();

        return view('detallesayuda.index', compact('detallesayudas'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesayudas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesayuda = new Detallesayuda();
        return view('detallesayuda.create', compact('detallesayuda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesayuda::$rules);

        $detallesayuda = Detallesayuda::create($request->all());

        return redirect()->route('detallesayudas.index')
            ->with('success', 'Detallesayuda created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesayuda = Detallesayuda::find($id);

        return view('detallesayuda.show', compact('detallesayuda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesayuda = Detallesayuda::find($id);

        return view('detallesayuda.edit', compact('detallesayuda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesayuda $detallesayuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesayuda $detallesayuda)
    {
        request()->validate(Detallesayuda::$rules);

        $detallesayuda->update($request->all());

        return redirect()->route('detallesayudas.index')
            ->with('success', 'Detallesayuda updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesayuda = Detallesayuda::find($id)->delete();

        return redirect()->route('detallesayudas.index')
            ->with('success', 'Detallesayuda deleted successfully');
    }
}
