<?php

namespace App\Http\Controllers;

use App\Poa;
use Illuminate\Http\Request;

/**
 * Class PoaController
 * @package App\Http\Controllers
 */
class PoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poas = Poa::paginate();

        return view('poa.index', compact('poas'))
            ->with('i', (request()->input('page', 1) - 1) * $poas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poa = new Poa();
        return view('poa.create', compact('poa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Poa::$rules);

        $poa = Poa::create($request->all());

        return redirect()->route('poas.index')
            ->with('success', 'Poa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poa = Poa::find($id);

        return view('poa.show', compact('poa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poa = Poa::find($id);

        return view('poa.edit', compact('poa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Poa $poa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poa $poa)
    {
        request()->validate(Poa::$rules);

        $poa->update($request->all());

        return redirect()->route('poas.index')
            ->with('success', 'Poa updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $poa = Poa::find($id)->delete();

        return redirect()->route('poas.index')
            ->with('success', 'Poa deleted successfully');
    }
}
