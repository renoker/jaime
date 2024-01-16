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
        $this->view = 'Centros de acopio';
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
        } elseif ($user->level_id == 2) {
            $order = Acopio::where('user_id', $user->id)->get();
        } else {
            $order = [];
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
        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcopioRequest $request)
    {
        $row = new Acopio();

        $row->user_id = $request->user_id;
        $row->compania = $request->compania;
        $row->name = $request->name;
        $row->phone = $request->phone;
        $row->address = $request->address;
        $row->address_two = $request->address_two;

        $row->save();

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

        $acopio->user_id = $request->user_id;
        $acopio->compania = $request->compania;
        $acopio->name = $request->name;
        $acopio->phone = $request->phone;
        $acopio->address = $request->address;
        $acopio->address_two = $request->address_two;

        $acopio->save();

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
