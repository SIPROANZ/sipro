<?php

namespace App\Http\Controllers;

use App\Notadebito;
use Illuminate\Http\Request;

/**
 * Class NotadebitoController
 * @package App\Http\Controllers
 */
class NotadebitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notadebitos = Notadebito::paginate();

        return view('notadebito.index', compact('notadebitos'))
            ->with('i', (request()->input('page', 1) - 1) * $notadebitos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notadebito = new Notadebito();
        return view('notadebito.create', compact('notadebito'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Notadebito::$rules);

        $notadebito = Notadebito::create($request->all());

        return redirect()->route('notadebitos.index')
            ->with('success', 'Notadebito created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notadebito = Notadebito::find($id);

        return view('notadebito.show', compact('notadebito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notadebito = Notadebito::find($id);

        return view('notadebito.edit', compact('notadebito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notadebito $notadebito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notadebito $notadebito)
    {
        request()->validate(Notadebito::$rules);

        $notadebito->update($request->all());

        return redirect()->route('notadebitos.index')
            ->with('success', 'Notadebito updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notadebito = Notadebito::find($id)->delete();

        return redirect()->route('notadebitos.index')
            ->with('success', 'Notadebito deleted successfully');
    }
}
