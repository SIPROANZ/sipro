<?php

namespace App\Http\Controllers;

use App\Ayudassociale;
use App\Unidadadministrativa;
use App\Tipodecompromiso;
use App\Beneficiario;
use Illuminate\Http\Request;

/**
 * Class AyudassocialeController
 * @package App\Http\Controllers
 */
class AyudassocialeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayudassociales = Ayudassociale::paginate();

        return view('ayudassociale.index', compact('ayudassociales'))
            ->with('i', (request()->input('page', 1) - 1) * $ayudassociales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ayudassociale = new Ayudassociale();

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $tipodecompromisos = Tipodecompromiso::pluck('nombre', 'id');
        $beneficiarios = Beneficiario::pluck('nombre', 'id');

        return view('ayudassociale.create', compact('ayudassociale', 'unidadesadministrativas', 'tipodecompromisos', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ayudassociale::$rules);

        $ayudassociale = Ayudassociale::create($request->all());

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayudassociale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ayudassociale = Ayudassociale::find($id);

        return view('ayudassociale.show', compact('ayudassociale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ayudassociale = Ayudassociale::find($id);

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $tipodecompromisos = Tipodecompromiso::pluck('nombre', 'id');
        $beneficiarios = Beneficiario::pluck('nombre', 'id');

        return view('ayudassociale.edit', compact('ayudassociale', 'unidadesadministrativas', 'tipodecompromisos', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ayudassociale $ayudassociale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ayudassociale $ayudassociale)
    {
        request()->validate(Ayudassociale::$rules);

        $ayudassociale->update($request->all());

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayudassociale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ayudassociale = Ayudassociale::find($id)->delete();

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayudassociale deleted successfully');
    }
}
