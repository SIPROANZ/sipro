<?php

namespace App\Http\Controllers;

use App\Bo;
use App\Producto;
use App\Productoscp;
use App\Unidadmedida;
use App\Tipobo;
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
        $productoscp = Productoscp::pluck('id');
        $unidadmedida = Unidadmedida::pluck('nombre', 'id');
        $tipobo = Tipobo::pluck('nombre', 'id');
        return view('bo.create', compact('bo', 'productoscp', 'unidadmedida', 'tipobo'));
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
            ->with('success', 'BOS creada con Exito.');
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
        $productoscp = Productoscp::pluck('id');
        $unidadmedida = Unidadmedida::pluck('nombre', 'id');
        $tipobo = Tipobo::pluck('nombre', 'id');
        return view('bo.edit', compact('bo', 'productoscp', 'unidadmedida', 'tipobo'));
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
            ->with('success', 'BOS modificada con Exito.');
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
            ->with('success', 'BOS eliminada con Exito');
    }
}
