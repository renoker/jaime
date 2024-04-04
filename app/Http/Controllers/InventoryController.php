<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Acopio;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
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
        $this->folder = 'inventario';
        $this->view = 'Iventario interno';
        $this->index = 'inventory.index';
        $this->create = 'inventory.create';
        $this->store = 'inventory.store';
        $this->update = 'inventory.update';
        $this->edit = 'inventory.edit';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        $acopio = Acopio::where('id', $user->acopio_id)->first();
        $inventory = Inventory::where('acopio_id', $acopio->id)->get();
        return view("pages.{$this->folder}.index", [
            'list'      => $inventory,
            'view'      => $this->view,
            'create'    => $this->create
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('web')->user();
        $acopio = Acopio::where('id', $user->acopio_id)->first();
        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'     => $this->index,
            'store'     => $this->store,
            'acopio'    => $acopio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        $row = new Inventory();

        $row->acopio_id = $request->acopio_id;
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/inventario/'), $imageName);
                    $row->image = 'assets/inventario/' . $imageName;
                } else {
                    return redirect()->route($this->create)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->create)->with('statusError', '¡Imagen no valida!');
            }
        }
        $row->clave = $request->clave;
        $row->descripcion = $request->descripcion;
        $row->principal_activo = $request->principal_activo;
        $row->laboratorio = $request->laboratorio;
        $row->iva = $request->iva;
        $row->pecio_maximo = $request->pecio_maximo;
        $row->descuento = $request->descuento;
        $row->pecio = $request->pecio;
        $row->pecio_anterior = $request->pecio_anterior;
        $row->stock = $request->stock;
        $row->contenido = $request->contenido;
        $row->comentarios = $request->comentarios;
        $row->caducidad = $request->caducidad;
        $row->codigo_barras = $request->codigo_barras;

        $row->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        return view("pages.{$this->folder}.edit", [
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
            'row'               => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/medicamentos/'), $imageName);
                    $inventory->image = 'assets/medicamentos/' . $imageName;
                } else {
                    return redirect()->route($this->edit, $inventory->id)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->edit, $inventory->id)->with('statusError', '¡Imagen no valida!');
            }
        }
        $inventory->clave = $request->clave;
        $inventory->descripcion = $request->descripcion;
        $inventory->principal_activo = $request->principal_activo;
        $inventory->laboratorio = $request->laboratorio;
        $inventory->iva = $request->iva;
        $inventory->pecio_maximo = $request->pecio_maximo;
        $inventory->descuento = $request->descuento;
        $inventory->pecio = $request->pecio;
        $inventory->pecio_anterior = $request->pecio_anterior;
        $inventory->stock = $request->stock;
        $inventory->contenido = $request->contenido;
        $inventory->comentarios = $request->comentarios;
        $inventory->caducidad = $request->caducidad;
        $inventory->codigo_barras = $request->codigo_barras;

        $inventory->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route($this->index)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
