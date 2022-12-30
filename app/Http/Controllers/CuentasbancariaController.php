<?php

namespace App\Http\Controllers;

use App\Cuentasbancaria;
use Illuminate\Http\Request;

/**
 * Class CuentasbancariaController
 * @package App\Http\Controllers
 */
class CuentasbancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentasbancarias = Cuentasbancaria::paginate();

        return view('cuentasbancaria.index', compact('cuentasbancarias'))
            ->with('i', (request()->input('page', 1) - 1) * $cuentasbancarias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentasbancaria = new Cuentasbancaria();
        return view('cuentasbancaria.create', compact('cuentasbancaria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cuentasbancaria::$rules);

        $cuentasbancaria = Cuentasbancaria::create($request->all());

        return redirect()->route('cuentasbancarias.index')
            ->with('success', 'Cuentasbancaria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuentasbancaria = Cuentasbancaria::find($id);

        return view('cuentasbancaria.show', compact('cuentasbancaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentasbancaria = Cuentasbancaria::find($id);

        return view('cuentasbancaria.edit', compact('cuentasbancaria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cuentasbancaria $cuentasbancaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuentasbancaria $cuentasbancaria)
    {
        request()->validate(Cuentasbancaria::$rules);

        $cuentasbancaria->update($request->all());

        return redirect()->route('cuentasbancarias.index')
            ->with('success', 'Cuentasbancaria updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cuentasbancaria = Cuentasbancaria::find($id)->delete();

        return redirect()->route('cuentasbancarias.index')
            ->with('success', 'Cuentasbancaria deleted successfully');
    }
}
