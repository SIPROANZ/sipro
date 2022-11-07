<?php

namespace App\Http\Controllers;

use App\Meta;
use Illuminate\Http\Request;

/**
 * Class MetaController
 * @package App\Http\Controllers
 */
class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metas = Meta::paginate();

        return view('meta.index', compact('metas'))
            ->with('i', (request()->input('page', 1) - 1) * $metas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = new Meta();
        return view('meta.create', compact('meta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Meta::$rules);

        $meta = Meta::create($request->all());

        return redirect()->route('metas.index')
            ->with('success', 'Meta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meta = Meta::find($id);

        return view('meta.show', compact('meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = Meta::find($id);

        return view('meta.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Meta $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $meta)
    {
        request()->validate(Meta::$rules);

        $meta->update($request->all());

        return redirect()->route('metas.index')
            ->with('success', 'Meta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $meta = Meta::find($id)->delete();

        return redirect()->route('metas.index')
            ->with('success', 'Meta deleted successfully');
    }
}
