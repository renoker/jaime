<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicineStockAcopioRequest;
use App\Http\Requests\UpdateMedicineStockAcopioRequest;
use App\Models\MedicineStockAcopio;
use Illuminate\Http\Request;

class MedicineStockAcopioController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineStockAcopioRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicineStockAcopio $medicineStockAcopio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineStockAcopio $medicineStockAcopio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicineStockAcopioRequest $request, MedicineStockAcopio $medicineStockAcopio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicineStockAcopio $medicineStockAcopio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getBox(Request $request)
    {
        $box = MedicineStockAcopio::where('id', $request->id)->first();
        $response = Response(['response' => $box], 200);
        return $response;
    }
}
