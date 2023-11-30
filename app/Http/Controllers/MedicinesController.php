<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicinesRequest;
use App\Http\Requests\UpdateMedicinesRequest;
use App\Models\Medicines;
use App\Models\StatesMedication;

class MedicinesController extends Controller
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
        $this->folder = 'medicamentos';
        $this->view = 'Medicamentos';
        $this->index = 'medicine.index';
        $this->create = 'medicine.create';
        $this->store = 'medicine.store';
        $this->update = 'medicine.update';
        $this->edit = 'medicine.edit';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Medicines::all();
        return view("pages.{$this->folder}.index", [
            'list'  => $users,
            'view'  => $this->view,
            'create'  => $this->create,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statesMedication = StatesMedication::all();
        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'statesMedication'      => $statesMedication,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicinesRequest $request)
    {
        $row = new Medicines;

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/medicamentos/'), $imageName);
                    $row->image = 'assets/medicamentos/' . $imageName;
                } else {
                    return redirect()->route($this->create)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->create)->with('statusError', '¡Imagen no valida!');
            }
        }
        $row->name = $request->name;
        $row->contenido = $request->contenido;
        $row->states_medication_id = $request->states_medication_id;

        $row->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicines $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicines $medicine)
    {
        $statesMedication = StatesMedication::all();
        return view("pages.{$this->folder}.edit", [
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
            'statesMedication'  => $statesMedication,
            'row'               => $medicine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicinesRequest $request, Medicines $medicine)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/medicamentos/'), $imageName);
                    $medicine->image = 'assets/medicamentos/' . $imageName;
                } else {
                    return redirect()->route($this->edit, $medicine)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->edit, $medicine)->with('statusError', '¡Imagen no valida!');
            }
        }
        $medicine->name = $request->name;
        $medicine->contenido = $request->contenido;
        $medicine->states_medication_id = $request->states_medication_id;

        $medicine->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicines $medicine)
    {
        $medicine->delete();
        return redirect()->route($this->index)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
