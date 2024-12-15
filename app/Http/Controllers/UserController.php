<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Acopio;
use App\Models\Level;
use App\Models\OrdenMedina;
use App\Models\Order;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $folder;
    private $view;
    private $index;
    private $create;
    private $store;
    private $update;

    function __construct()
    {
        $this->folder = 'usuarios';
        $this->view = 'Usuarios';
        $this->index = 'user.index';
        $this->create = 'user.create';
        $this->store = 'user.store';
        $this->update = 'user.update';
    }

    // Listado de usuarios
    public function index()
    {
        $user = Auth::guard('web')->user();
        if ($user->level_id == 1) {
            $users = User::with('level')->get();
        } elseif ($user->level_id == 2) {
            $users = User::with('level')->get();
        }

        return view("pages.{$this->folder}.index", [
            'list'  => $users,
            'view'  => $this->view,
            'create'  => $this->create,
        ]);
    }

    // Listado de usuarios
    public function home()
    {
        $user = Auth::guard('web')->user();

        if ($user->level_id == 1) {

            $sum = OrdenMedina::select(DB::raw('SUM(pecio * cantidad) as total'))
                ->join('orders', 'orden_medinas.order_id', '=', 'orders.id')
                ->where('orders.status_orden_id', 5)
                ->first();

            $pendientes = OrdenMedina::select(DB::raw('SUM(pecio * cantidad) as total'))
                ->join('orders', 'orden_medinas.order_id', '=', 'orders.id')
                ->where('orders.status_orden_id', 1)
                ->first();

            $acopios = Acopio::count();

            return view("pages.home_admin", [
                'ventas' => number_format($sum->total, 2),
                'pendientes' => number_format($pendientes->total, 2),
                'acopios' => $acopios
            ]);
        } elseif ($user->level_id == 2) {

            $pasientes = Patient::where('acopio_id', $user->acopio_id)->get();
            $ordenes = Order::where('acopio_id', $user->acopio_id)->where('status_orden_id', 1)->get();

            $sum = OrdenMedina::select(DB::raw('SUM(pecio * cantidad) as total'))
                ->join('orders', 'orden_medinas.order_id', '=', 'orders.id')
                ->where('orders.status_orden_id', 5)->where('orders.acopio_id', $user->acopio_id)
                ->first();

            return view("pages.home", [
                'no_pacientes'          => $pasientes->count(),
                'ordenes_pendientes'    => $ordenes->count(),
                'compras_totales'    => number_format($sum->total, 2)
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level = Level::all();
        return view("pages.{$this->folder}.create", [
            'view'      => $this->view,
            'index'     => $this->index,
            'store'     => $this->store,
            'levels'    => $level,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $row = new User;

        $row->genre = $request->genre;
        $row->name = $request->name;
        $row->age = $request->age;
        $row->phone = $request->phone;
        $row->level_id = $request->level_id;
        $row->email = $request->email;
        $row->password = $request->password;

        $row->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila creada de manera exitosa!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $level = Level::all();
        return view("pages.{$this->folder}.edit", [
            'view'      => $this->view,
            'index'     => $this->index,
            'update'    => $this->update,
            'levels'    => $level,
            'row'       => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->genre = $request->genre;
        $user->name = $request->name;
        $user->age = $request->age;
        $user->phone = $request->phone;
        $user->level_id = $request->level_id;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect()->route($this->index)->with('statusAlta', '¡Fila actualizada de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route($this->index)->with('statusDelete', '¡Fila eliminada de manera exitosa!');
    }

    /*
     *
     ***************************************************************************/
    public function login()
    {
        return view('pages.login');
    }

    /*
     *
     ***************************************************************************/
    public function login_request(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            if ($user->level_id == 1) {
                return redirect()->route('user.index');
            } elseif ($user->level_id == 2) {
                return redirect()->route('user_edit.index');
            } elseif ($user->level_id == 3) {
                return redirect()->route('user_edit.index');
            }
        } else {
            return redirect()->back()->withErrors(['auth-validation' => 'Tus datos no son correctos. Inténtalo de nuevo.']);
        }
    }

    /*
     *
     ***************************************************************************/
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/');
    }

    // Listado de usuarios Editores
    public function userEditorIndex()
    {
        $user = Auth::guard('web')->user();
        $users = User::with('level')
            ->where('acopio_id', $user->acopio_id)
            ->whereNotNull('acopio_id')
            ->get();
        // dd($users);
        return view("pages.usuario_editor.index", [
            'list'      => $users,
            'view'      => $this->view,
            'create'    => 'user_edit.create',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function userEditorCreate()
    {
        return view("pages.usuario_editor.create", [
            'view'      => $this->view,
            'index'     => 'user_edit.index',
            'store'     => 'user_edit.store',
        ]);
    }

    public function userEditorStore(Request $request)
    {
        $user = Auth::guard('web')->user();
        $row = new User;

        $row->genre = $request->genre;
        $row->name = $request->name;
        $row->age = $request->age;
        $row->phone = $request->phone;
        $row->level_id = $request->level_id;
        $row->email = $request->email;
        $row->password = $request->password;
        $row->acopio_id = $user->acopio_id;

        $row->save();

        return redirect()->route('user_edit.index')->with('statusAlta', '¡Fila creada de manera exitosa!');
    }
}
