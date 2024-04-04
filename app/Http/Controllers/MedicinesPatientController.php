<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicinesPatientRequest;
use App\Http\Requests\UpdateMedicinesPatientRequest;
use App\Models\Acopio;
use App\Models\Inventory;
use App\Models\Medicines;
use App\Models\MedicinesPatient;
use App\Models\MedicineStockAcopio;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::guard('web')->user();
        $acopio = Acopio::where('id', $user->acopio_id)->first();
        $inventario = Inventory::where('acopio_id', $acopio->id)->where('stock', '>', 0)->get();
        $medicinas = MedicineStockAcopio::where('patient_id', $patient->id)->where('stock', '>', 0)->get();
        return view("pages.{$this->folder}.create", [
            'patient'   => $patient,
            'view'      => $this->view,
            'index'     => $this->index,
            'store'     => $this->store,
            'medicinas' => $medicinas,
            'inventario' => $inventario,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicinesPatientRequest $request)
    {

        if (!empty($request->inventorie_id)) {
            $inventario = Inventory::where('id', $request->inventorie_id)->first();
            if ($request->no_cajas <= $inventario->stock) {

                $row = new MedicinesPatient();

                $row->patient_id = $request->patient_id;
                $row->inventorie_id = $request->inventorie_id;
                $row->no_cajas = $request->no_cajas;
                $row->dosis = $request->dosis;
                $row->periodicidad = $request->periodicidad;
                $row->save();

                $inventario->stock = $inventario->stock - $request->no_cajas;
                $inventario->save();

                return redirect()->route($this->index, $request->patient_id)->with('statusAlta', '¡Fila creada de manera exitosa!');
            }
        }

        if (!empty($request->medicine_id)) {
            $inventario = MedicineStockAcopio::where('medicine_id', $request->medicine_id)->first();
            if ($request->no_cajas <= $inventario->stock) {

                $row = new MedicinesPatient();

                $row->patient_id = $request->patient_id;
                $row->medicine_id = $request->medicine_id;
                $row->no_cajas = $request->no_cajas;
                $row->dosis = $request->dosis;
                $row->periodicidad = $request->periodicidad;

                $row->save();

                $inventario->stock = $inventario->stock - $request->no_cajas;
                $inventario->save();

                return redirect()->route($this->index, $request->patient_id)->with('statusAlta', '¡Fila creada de manera exitosa!');
            }
        }
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

    public function getInventario(Request $request)
    {
        $box = Inventory::where('id', $request->id)->first();
        $response = Response(['response' => $box], 200);
        return $response;
    }

    public function suspendeMedicamento(Request $request)
    {
        $user = Auth::guard('web')->user();
        $acopio = Acopio::where('id', $user->acopio_id)->first();
        $medicinesPatient = MedicinesPatient::where('id', $request->id)->first();
        // obtenemos la información del medicamento 
        $medicamento = Medicines::where('id', $medicinesPatient->medicine_id)->first();

        // Guardamos el medicamento en el inventario
        $row = new Inventory;
        $row->acopio_id = $acopio->id;
        $row->image = $medicamento->image;
        $row->clave = $medicamento->clave;
        $row->descripcion = $medicamento->descripcion;
        $row->principal_activo = $medicamento->principal_activo;
        $row->laboratorio = $medicamento->laboratorio;
        $row->iva = $medicamento->iva;
        $row->pecio_maximo = $medicamento->pecio_maximo;
        $row->descuento = $medicamento->descuento;
        $row->pecio = $medicamento->pecio;
        $row->pecio_anterior = $medicamento->pecio_anterior;
        $row->stock = 0;
        $row->contenido = 0;
        $row->comentarios = $medicamento->comentarios;
        $row->caducidad = $medicamento->caducidad;
        $row->codigo_barras = $medicamento->codigo_barras;
        $row->save();

        $medicinesPatient->delete();


        $response = Response(['response' => $row], 200);
        return $response;
    }

    public function addPrice(Request $request)
    {
        $inventory = Inventory::where('id', $request->inventorie_id)->first();
        $inventory->stock = $request->stock;
        $inventory->contenido = $request->contenido;
        $inventory->save();
        $response = Response(['response' => $inventory], 200);
        return $response;
    }
}
