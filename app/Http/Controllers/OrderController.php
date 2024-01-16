<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Acopio;
use App\Models\Medicines;
use App\Models\OrdenMedina;
use App\Models\Order;
use App\Models\Patient;
use Auth;

class OrderController extends Controller
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
        $this->folder = 'orden';
        $this->view = 'Ordenes';
        $this->index = 'orden.index';
        $this->create = 'orden.create';
        $this->store = 'orden.store';
        $this->update = 'orden.update';
        $this->edit = 'orden.edit';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::with('acopio', 'status_orden')->get();
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
        $user = Auth::guard('web')->user();
        $medicinas = Medicines::where('stock', '>', 0)->get();
        $acopio = Acopio::where('user_id', $user->id)->first();
        $order = Order::where('acopio_id', $user->id)->get();
        $pacientes = Patient::where('acopio_id', $acopio->id)->get();

        $res = new Order();
        $res->acopio_id = $acopio->id;
        $res->save();

        return view("pages.{$this->folder}.create", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'medicinas'             => $medicinas,
            'user'                  => $user,
            'no_orden'              => $order->count() + 1,
            'acopio'                => $acopio,
            'pacientes'             => $pacientes,
            'idOrden'               => $res->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $user = Auth::guard('web')->user();
        $medicinas = Medicines::where('stock', '>', 0)->get();
        $order = Order::where('id', $order->id)->first();
        $acopio = Acopio::where('user_id', $user->id)->first();
        $pacientes = Patient::where('acopio_id', $acopio->id)->get();

        return view("pages.{$this->folder}.edit", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'medicinas'             => $medicinas,
            'user'                  => $user,
            'no_orden'              => $order->count() + 1,
            'acopio'                => $acopio,
            'pacientes'             => $pacientes,
            'idOrden'               => $order->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
