<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacturationRequest;
use App\Http\Requests\UpdateFacturationRequest;
use App\Models\Acopio;
use App\Models\Facturation;
use Illuminate\Support\Facades\Auth;

class FacturationController extends Controller
{
    private $folder;
    private $view;
    private $index;
    private $create;
    private $store;
    private $update;
    private $edit;

    function __construct()
    {
        $this->folder = 'centro_acopio.facturacion';
        $this->view = 'Facturación';
        $this->index = 'facturacion.index';
        $this->create = 'facturacion.create';
        $this->store = 'facturacion.store';
        $this->update = 'facturacion.update';
        $this->edit = 'facturacion.edit';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Acopio $acopio)
    {
        $facturacion = Facturation::with('acopio')->where('acopio_id', $acopio->id)->get();
        // dd($facturacion);
        return view("pages.{$this->folder}.index", [
            'list'      => $facturacion,
            'view'      => $this->view,
            'create'    => $this->create,
            'acopio'    => $acopio
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Acopio $acopio)
    {
        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'acopio'                => $acopio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturationRequest $request)
    {
        $row = new Facturation();

        $row->acopio_id = $request->acopio_id;
        $row->compania = $request->compania;
        $row->name = $request->name;
        $row->phone = $request->phone;
        $row->address = $request->address;
        $row->address_two = $request->address_two;

        $row->save();

        return redirect()->route($this->index, $row->acopio_id)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facturation $facturation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facturation $facturacion)
    {
        return view("pages.{$this->folder}.edit", [
            'row'               => $facturacion,
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturationRequest $request, Facturation $facturacion)
    {

        $facturacion->compania = $request->compania;
        $facturacion->name = $request->name;
        $facturacion->phone = $request->phone;
        $facturacion->address = $request->address;
        $facturacion->address_two = $request->address_two;

        $facturacion->save();

        return redirect()->route($this->index, $facturacion->acopio_id)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facturation $facturacion)
    {
        $facturacion->delete();
        return redirect()->route($this->index, $facturacion->acopio_id)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
