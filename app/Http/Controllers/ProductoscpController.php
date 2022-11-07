<?php

namespace App\Http\Controllers;

use App\Productoscp;
use App\Productos;
use App\Clasificadorpresupuestario;

use Illuminate\Http\Request;

/**
 * Class ProductoscpController
 * @package App\Http\Controllers
 */
class ProductoscpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productoscps = Productoscp::paginate();

        return view('productoscp.index', compact('productoscps'))
            ->with('i', (request()->input('page', 1) - 1) * $productoscps->perPage());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productoscp = new Productoscp();

        $clasificadorpresupuestarios  = Clasificadorpresupuestario::pluck('cuenta', 'id');
      //  $productos  = Producto::pluck('Codproducto', 'id');
      return view('productoscp.create', compact('productoscp' , 'clasificadorpresupuestarios'));

      //  return view('productoscp.create', compact('productoscp' , 'clasificadorpresupuestarios', 'productos'));

        $productos  = Producto::pluck('Codproducto', 'id');
        return view('productoscp.create', compact('productoscp' , 'productos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Productoscp::$rules);

        $productoscp = Productoscp::create($request->all());

        return redirect()->route('productoscps.index')
            ->with('success', 'Productoscp created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productoscp = Productoscp::find($id);

        return view('productoscp.show', compact('productoscp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productoscp = Productoscp::find($id);

        $clasificadorpresupuestarios = Clasificadorpresupuestario::pluck('cuenta', 'id');
        $productos = Producto::pluck('nombre', 'id');

        return view('productoscp.edit', compact('productoscp' , 'clasificadorpresupuestarios', 'productos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Productoscp $productoscp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productoscp $productoscp)
    {
        request()->validate(Productoscp::$rules);

        $productoscp->update($request->all());

        return redirect()->route('productoscps.index')
            ->with('success', 'Productoscp updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productoscp = Productoscp::find($id)->delete();

        return redirect()->route('productoscps.index')
            ->with('success', 'Productoscp deleted successfully');
    }
}
