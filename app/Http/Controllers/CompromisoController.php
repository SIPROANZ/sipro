<?php

namespace App\Http\Controllers;

use App\Compromiso;
use Illuminate\Http\Request;

/**
 * Class CompromisoController
 * @package App\Http\Controllers
 */
class CompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compromisos = Compromiso::paginate();

        return view('compromiso.index', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compromiso = new Compromiso();
        return view('compromiso.create', compact('compromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Compromiso::$rules);

        $compromiso = Compromiso::create($request->all());

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compromiso = Compromiso::find($id);

        return view('compromiso.show', compact('compromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compromiso = Compromiso::find($id);

        return view('compromiso.edit', compact('compromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Compromiso $compromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compromiso $compromiso)
    {
        request()->validate(Compromiso::$rules);

        $compromiso->update($request->all());

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compromiso = Compromiso::find($id)->delete();

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso deleted successfully');
    }
}
