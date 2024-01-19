<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdenMedinaRequest;
use App\Http\Requests\UpdateOrdenMedinaRequest;
use App\Models\Acopio;
use App\Models\Medicines;
use App\Models\OrdenMedina;
use App\Models\Order;
use Auth;

class OrdenMedinaController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdenMedinaRequest $request)
    {
        $row = new OrdenMedina();
        $row->order_id = $request->order_id;

        $row->save();

        $response = Response(['OrdenMedina' => $row->id], 200);
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdenMedina $ordenMedina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdenMedina $ordenMedina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdenMedinaRequest $request, OrdenMedina $ordenMedina)
    {
        $ordenMedina->patient_id = $request->patient_id;
        $ordenMedina->medicine_id = $request->medicine_id;
        $ordenMedina->cantidad = $request->cantidad;
        $ordenMedina->pecio = Medicines::find($request->medicine_id)->pecio ?? null;

        $ordenMedina->save();

        $response = Response(['response' => $request->patient_id], 200);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdenMedina $ordenMedina)
    {
        $ordenMedina->delete();
        return Response(['response' => $ordenMedina], 200);
    }

    public function getOrdenMedicina(Order $order)
    {
        $medicinas = OrdenMedina::where('order_id', $order->id)->get();

        $total = OrdenMedina::where('order_id', $order->id)->sum('pecio');

        $iva = $total * 0.16;
        $subtotal = $total - $iva;

        $response = Response(['list' => $medicinas, 'total' => number_format($total, 2, '.', ','), 'iva' => number_format($iva, 2, '.', ','), 'subtotal' => number_format($subtotal, 2, '.', ',')], 200);
        return $response;
    }
}
