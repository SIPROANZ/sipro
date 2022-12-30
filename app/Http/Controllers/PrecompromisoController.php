<?php

namespace App\Http\Controllers;

use App\Precompromiso;
use Illuminate\Http\Request;

/**
 * Class PrecompromisoController
 * @package App\Http\Controllers
 */
class PrecompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precompromisos = Precompromiso::paginate();

        return view('precompromiso.index', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precompromiso = new Precompromiso();
        return view('precompromiso.create', compact('precompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso = Precompromiso::create($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precompromiso = Precompromiso::find($id);

        return view('precompromiso.show', compact('precompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $precompromiso = Precompromiso::find($id);

        return view('precompromiso.edit', compact('precompromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Precompromiso $precompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precompromiso $precompromiso)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso->update($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $precompromiso = Precompromiso::find($id)->delete();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso deleted successfully');
    }
}
