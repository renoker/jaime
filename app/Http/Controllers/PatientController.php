<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Acopio;
use App\Models\MedicinesPatient;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
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
        $this->folder = 'pacientes';
        $this->view = 'Pacientes';
        $this->index = 'patient.index';
        $this->create = 'patient.create';
        $this->store = 'patient.store';
        $this->update = 'patient.update';
        $this->edit = 'patient.edit';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();

        $pacientes = Patient::with('acopio')->where('acopio_id', $user->acopio_id)->get();
        return view("pages.{$this->folder}.index", [
            'list'  => $pacientes,
            'view'  => $this->view,
            'create'  => $this->create,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('web')->user();
        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'user'                => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $row = new Patient;

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/pacientes/'), $imageName);
                    $row->image = 'assets/pacientes/' . $imageName;
                } else {
                    return redirect()->route($this->create)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->create)->with('statusError', '¡Imagen no valida!');
            }
        }
        $row->name = $request->name;
        $row->edad = $request->edad;
        $row->direccion = $request->direccion;
        $row->cumpleanios = $request->cumpleanios;
        $row->email = $request->email;
        $row->telefono = $request->telefono;
        $row->acopio_id = $request->acopio_id;

        $row->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view("pages.{$this->folder}.edit", [
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
            'row'               => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/pacientes/'), $imageName);
                    $patient->image = 'assets/pacientes/' . $imageName;
                } else {
                    return redirect()->route($this->create)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route($this->create)->with('statusError', '¡Imagen no valida!');
            }
        }
        $patient->name = $request->name;
        $patient->edad = $request->edad;
        $patient->direccion = $request->direccion;
        $patient->profecion = $request->profecion;
        $patient->cumpleanios = $request->cumpleanios;
        $patient->email = $request->email;
        $patient->telefono = $request->telefono;
        $patient->acopio_id = $request->acopio_id;

        $patient->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function profile(Patient $patient)
    {
        $medicamentos = MedicinesPatient::where('patient_id', $patient->id)->get();
        return view("pages.{$this->folder}.perfil", [
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
            'row'               => $patient,
            'medicamentos'      => $medicamentos,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route($this->index)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
