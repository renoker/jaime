<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressSendRequest;
use App\Http\Requests\UpdateAddressSendRequest;
use App\Models\Acopio;
use App\Models\AddressSend;

class AddressSendController extends Controller
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
        $this->folder = 'centro_acopio.direccion_envio';
        $this->view = 'Dirección de envío';
        $this->index = 'address_send.index';
        $this->create = 'address_send.create';
        $this->store = 'address_send.store';
        $this->update = 'address_send.update';
        $this->edit = 'address_send.edit';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Acopio $acopio)
    {
        $direccion_envio = AddressSend::with('acopio')->where('acopio_id', $acopio->id)->get();
        // dd($direccion_envio);
        return view("pages.{$this->folder}.index", [
            'list'      => $direccion_envio,
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
    public function store(StoreAddressSendRequest $request)
    {
        $row = new AddressSend();

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
    public function show(AddressSend $address_send)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddressSend $address_send)
    {
        return view("pages.{$this->folder}.edit", [
            'row'               => $address_send,
            'view'              => $this->view,
            'index'             => $this->index,
            'update'            => $this->update,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressSendRequest $request, AddressSend $address_send)
    {

        $address_send->compania = $request->compania;
        $address_send->name = $request->name;
        $address_send->phone = $request->phone;
        $address_send->address = $request->address;
        $address_send->address_two = $request->address_two;

        $address_send->save();

        return redirect()->route($this->index, $address_send->acopio_id)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddressSend $address_send)
    {
        $address_send->delete();
        return redirect()->route($this->index, $address_send->acopio_id)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }
}
