<?php

namespace App\Http\Controllers;

use App\Bo;
use Illuminate\Http\Request;

/**
 * Class BoController
 * @package App\Http\Controllers
 */
class BoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bos = Bo::paginate();

        return view('bo.index', compact('bos'))
            ->with('i', (request()->input('page', 1) - 1) * $bos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bo = new Bo();
        return view('bo.create', compact('bo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Bo::$rules);

        $bo = Bo::create($request->all());

        return redirect()->route('bos.index')
            ->with('success', 'Bo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bo = Bo::find($id);

        return view('bo.show', compact('bo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bo = Bo::find($id);

        return view('bo.edit', compact('bo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bo $bo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bo $bo)
    {
        request()->validate(Bo::$rules);

        $bo->update($request->all());

        return redirect()->route('bos.index')
            ->with('success', 'Bo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bo = Bo::find($id)->delete();

        return redirect()->route('bos.index')
            ->with('success', 'Bo deleted successfully');
    }
}
