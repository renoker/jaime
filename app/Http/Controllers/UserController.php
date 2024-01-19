<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
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
        $users = User::with('level')->get();
        return view("pages.{$this->folder}.index", [
            'list'  => $users,
            'view'  => $this->view,
            'create'  => $this->create,
        ]);
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

    public function store(Request $request)
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
            return redirect()->route('user.index');
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
}
