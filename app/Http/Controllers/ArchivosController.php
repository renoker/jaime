<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArchivosRequest;
use App\Http\Requests\UpdateArchivosRequest;
use App\Models\Acopio;
use App\Models\Archivos;

class ArchivosController extends Controller
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
        $this->folder = 'centro_acopio.archivos';
        $this->view = 'Archivos';
        $this->index = 'archivos.index';
        $this->create = 'archivos.create';
        $this->store = 'archivos.store';
        $this->update = 'archivos.update';
        $this->edit = 'archivos.edit';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Acopio $acopio)
    {
        $facturacion = Archivos::where('acopio_id', $acopio->id)->get();
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
    public function store(StoreArchivosRequest $request)
    {
        $row = new Archivos();

        $row->acopio_id = $request->acopio_id;
        $row->name = $request->name;
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp', 'pdf'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/archivos/'), $imageName);
                    $row->image = 'assets/archivos/' . $imageName;
                } else {
                    return redirect()->route($this->create)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->create, $request->acopio_id)->with('statusError', '¡Imagen no valida!');
            }
        }


        $row->save();

        return redirect()->route($this->index, $request->acopio_id)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Archivos $archivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archivos $archivos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArchivosRequest $request, Archivos $archivos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archivos $archivo)
    {
        $archivo->delete();
        return redirect()->route($this->index, $archivo->acopio_id)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
