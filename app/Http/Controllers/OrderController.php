<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Acopio;
use App\Models\AddressSend;
use App\Models\Facturation;
use App\Models\Medicines;
use App\Models\MedicineStockAcopio;
use App\Models\OrdenMedina;
use App\Models\Order;
use App\Models\Patient;
use App\Models\StatusOrden;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $user = Auth::guard('web')->user();
        if ($user->level_id == 1) {
            $order = Order::with('acopio', 'status_orden')->get();
        } else {
            $order = Order::with('acopio', 'status_orden')->where('acopio_id', $user->acopio_id)->get();
        }

        return view("pages.{$this->folder}.index", [
            'list'      => $order,
            'view'      => $this->view,
            'create'    => $this->create,
            'user'      => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('web')->user();
        $medicinas = Medicines::all();
        $acopio = Acopio::where('id', $user->acopio_id)->first();
        $order = Order::where('acopio_id', $user->id)->get();
        $pacientes = Patient::where('acopio_id', $acopio->id)->get();
        $facturacion = Facturation::where('acopio_id', $acopio->id)->first();
        $direccion_envio = AddressSend::where('acopio_id', $acopio->id)->first();

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
            'facturacion'           => $facturacion,
            'direccion_envio'       => $direccion_envio,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $row = Order::where('id', $request->order_id)->first();
        $row->notas = $request->notas;
        $row->fecha = $request->fecha;

        $row->save();

        $response = Response(['orden' => $row], 200);
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addTicket(Request $request)
    {
        $row = Order::where('id', $request->orden_id)->first();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                if (in_array($request->file('image')->extension(), ['jpg', 'jpeg', 'png', 'webp', 'pdf'])) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/comprobantes/'), $imageName);
                    $row->image = 'assets/comprobantes/' . $imageName;
                } else {
                    return redirect()->route('orden.preview', $request->orden_id)->with('statusError', '¡Imagen no cumple con el formato!');
                }
            } else {
                return redirect()->route('orden.preview', $request->orden_id)->with('statusError', '¡Imagen no valida!');
            }
        }
        $row->status_orden_id = 3;
        $row->save();

        return redirect()->route('orden.preview', $request->orden_id)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }



    /**
     * Display the specified resource.
     */
    public function preview(Order $order)
    {
        $user = Auth::guard('web')->user();
        $medicinas = OrdenMedina::where('order_id', $order->id)->get();
        $facturacion = Facturation::where('acopio_id', $order->acopio_id)->first();
        $direccion_envio = AddressSend::where('acopio_id', $order->acopio_id)->first();
        $result = OrdenMedina::where('order_id', $order->id)->selectRaw('SUM(pecio * cantidad) as total')->first();
        // dd($total);
        $status_orden = StatusOrden::all();
        $iva = $result->total * 0.16;
        $subtotal = $result->total - $iva;

        return view("pages.{$this->folder}.preview", [
            'user'                  => $user,
            'order'                 => $order,
            'facturacion'           => $facturacion,
            'direccion_envio'       => $direccion_envio,
            'medicinas'             => $medicinas,
            'subtotal'              => $subtotal,
            'iva'                   => $iva,
            'total'                 => $result->total,
            'status_orden'          => $status_orden,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $user = Auth::guard('web')->user();
        $medicinas = Medicines::where('stock', '>', 0)->get();
        $acopio = Acopio::where('id', $user->acopio_id)->first();
        $pacientes = Patient::where('acopio_id', $acopio->id)->get();
        $facturacion = Facturation::where('acopio_id', $acopio->id)->first();
        $direccion_envio = AddressSend::where('acopio_id', $acopio->id)->first();

        return view("pages.{$this->folder}.edit", [
            'view'                  => $this->view,
            'index'                 => $this->index,
            'store'                 => $this->store,
            'medicinas'             => $medicinas,
            'user'                  => $user,
            'no_orden'              => $order->count() + 1,
            'acopio'                => $acopio,
            'pacientes'             => $pacientes,
            'order'                 => $order,
            'facturacion'           => $facturacion,
            'direccion_envio'       => $direccion_envio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route($this->index)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }

    public function change_status_order(Request $request)
    {
        $date = Carbon::now();
        $formattedDate = $date->format('Y-m-d H:i:s');

        $order = Order::where('id', $request->order_id)->first();
        $order->status_orden_id = $request->status_orden_id;
        $order->save();

        if ($request->status_orden_id == 5) {
            $orden_cliente = OrdenMedina::where('order_id', $order->id)->get();

            foreach ($orden_cliente as $res) {
                $row = new MedicineStockAcopio();
                $row->acopio_id = $order->acopio_id;
                $row->medicine_id = $res->medicine_id;
                $row->patient_id = $res->patient_id;
                $row->stock = $res->cantidad;
                $row->ingreso_almacen = $formattedDate;
                $row->save();
            }

            $response = Response(['order' => $orden_cliente], 200);
            return $response;
        }
    }

    public function change_price(Request $request)
    {

        $order = OrdenMedina::where('id', $request->id)->first();
        $order->pecio = $request->pecio;
        $order->save();

        $result = OrdenMedina::where('order_id', $order->order_id)->selectRaw('SUM(pecio * cantidad) as total')->first();
        $iva = $result->total * 0.16;
        $subtotal = $result->total - $iva;

        $response = Response(['pecio' => number_format($order->pecio, 2, ".", ","), 'total' => number_format($result->total, 2, ".", ","), 'iva' => number_format($iva, 2, ".", ","), 'subtotal' => number_format($subtotal, 2, ".", ",")], 200);
        return $response;
    }
}
