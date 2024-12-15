<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcopioRequest;
use App\Http\Requests\UpdateAcopioRequest;
use App\Models\Acopio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AcopioController extends Controller
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
        $this->folder = 'centro_acopio';
        $this->view = 'Comunidades religiosas';
        $this->index = 'acopio.index';
        $this->create = 'acopio.create';
        $this->store = 'acopio.store';
        $this->update = 'acopio.update';
        $this->edit = 'acopio.edit';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        if ($user->level_id == 1) {
            $order = Acopio::all();
        }
        return view("pages.{$this->folder}.index", [
            'list'  => $order,
            'view'  => $this->view,
            'create'  => $this->create,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('level_id', 2)->get();
        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'directores'            => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcopioRequest $request)
    {
        $row = new Acopio();

        $row->compania = $request->compania;
        $row->name = $request->name;
        $row->phone = $request->phone;
        $row->address = $request->address;
        $row->address_two = $request->address_two;

        // Guardar el nuevo acopio
        $row->save();

        $user = User::find($request->user_id);
        if ($user) {
            $user->acopio_id = $row->id;
            $user->save();
        }

        return redirect()->route($this->index)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Acopio $acopio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acopio $acopio)
    {
        $user = User::where('level_id', 2)->get();
        return view("pages.{$this->folder}.edit", [
            'row'               => $acopio,
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
            'directores'        => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcopioRequest $request, Acopio $acopio)
    {
        // Actualizar los datos del acopio
        $acopio->compania = $request->compania;
        $acopio->name = $request->name;
        $acopio->phone = $request->phone;
        $acopio->address = $request->address;
        $acopio->address_two = $request->address_two;

        // Guardar los cambios en el acopio
        $acopio->save();

        // Actualizar el acopio_id en un usuario específico
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            if ($user) {
                $user->acopio_id = $acopio->id;
                $user->save();
            }
        }

        return redirect()->route($this->index)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acopio $acopio)
    {
        $acopio->delete();
        return redirect()->route($this->index)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
