<?php

namespace App\Http\Controllers;

use App\Beneficiario;
use Illuminate\Http\Request;

/**
 * Class BeneficiarioController
 * @package App\Http\Controllers
 */
class BeneficiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiarios = Beneficiario::paginate();

        return view('beneficiario.index', compact('beneficiarios'))
            ->with('i', (request()->input('page', 1) - 1) * $beneficiarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beneficiario = new Beneficiario();
        return view('beneficiario.create', compact('beneficiario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Beneficiario::$rules);

        $beneficiario = Beneficiario::create($request->all());

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiario = Beneficiario::find($id);

        return view('beneficiario.show', compact('beneficiario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiario = Beneficiario::find($id);

        return view('beneficiario.edit', compact('beneficiario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Beneficiario $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiario $beneficiario)
    {
        request()->validate(Beneficiario::$rules);

        $beneficiario->update($request->all());

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $beneficiario = Beneficiario::find($id)->delete();

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiario deleted successfully');
    }
}
