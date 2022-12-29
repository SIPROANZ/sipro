<?php

namespace App\Http\Controllers;

use App\Comprascp;
use Illuminate\Http\Request;

/**
 * Class ComprascpController
 * @package App\Http\Controllers
 */
class ComprascpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comprascps = Comprascp::paginate();

        return view('comprascp.index', compact('comprascps'))
            ->with('i', (request()->input('page', 1) - 1) * $comprascps->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comprascp = new Comprascp();
        return view('comprascp.create', compact('comprascp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comprascp::$rules);

        $comprascp = Comprascp::create($request->all());

        return redirect()->route('comprascps.index')
            ->with('success', 'Comprascp created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprascp = Comprascp::find($id);

        return view('comprascp.show', compact('comprascp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprascp = Comprascp::find($id);

        return view('comprascp.edit', compact('comprascp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comprascp $comprascp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comprascp $comprascp)
    {
        request()->validate(Comprascp::$rules);

        $comprascp->update($request->all());

        return redirect()->route('comprascps.index')
            ->with('success', 'Comprascp updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comprascp = Comprascp::find($id)->delete();

        return redirect()->route('comprascps.index')
            ->with('success', 'Comprascp deleted successfully');
    }
}
