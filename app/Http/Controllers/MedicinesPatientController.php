<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicinesPatientRequest;
use App\Http\Requests\UpdateMedicinesPatientRequest;
use App\Models\MedicinesPatient;
use App\Models\MedicineStockAcopio;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicinesPatientController extends Controller
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
        $this->folder = 'pacientes.medicamentos';
        $this->view = 'Medicamentos';
        $this->index = 'patient.profile';
        $this->create = 'medicine_patiente.create';
        $this->store = 'medicine_patiente.store';
        $this->update = 'medicine_patiente.update';
        $this->edit = 'medicine_patiente.edit';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Patient $patient)
    {
        $medicinas = MedicineStockAcopio::where('patient_id', $patient->id)->get();
        return view("pages.{$this->folder}.create", [
            'patient'   => $patient,
            'view'      => $this->view,
            'index'     => $this->index,
            'store'     => $this->store,
            'medicinas' => $medicinas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicinesPatientRequest $request)
    {
        $row = new MedicinesPatient();

        $row->patient_id = $request->patient_id;
        $row->medicine_id = $request->medicine_id;
        $row->no_cajas = $request->no_cajas;
        $row->dosis = $request->dosis;
        $row->periodicidad = $request->periodicidad;

        $row->save();

        return redirect()->route($this->index, $request->patient_id)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicinesPatient $medicinesPatient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicinesPatient $medicinesPatient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicinesPatientRequest $request, MedicinesPatient $medicinesPatient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicinesPatient $medicinesPatient)
    {
        //
    }

    public function getBox(Request $request)
    {
        $box = MedicineStockAcopio::where('id', $request->id)->first();
        $response = Response(['response' => $box], 200);
        return $response;
    }
}
