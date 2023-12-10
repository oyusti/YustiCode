<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Laravel\Jetstream\Rules\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /* Puedo proteger cualquier metodo demanera individual de esta forma, si lo hago por aca
    no utilizoel middleware en las rutas */
    
    /* public function __construct()
    {
        $this->middleware('can:Gestion de Roles')->only('index', 'create', 'store', 'edit', 'update', 'destroy');
    } */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:roles',
            'permissions' => 'nullable | array'
        ]);

        $role = Role::create($request->all());

        $role->permissions()->sync($request->permissions);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El rol ha sido creado correctamente'
        ]);

        return redirect()->route('admin.roles.index', $role);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required | unique:roles,name,' . $role->id,
            'permissions' => 'nullable | array'
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El rol ha sido actualizado correctamente'
        ]);

        return redirect()->route('admin.roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El rol ha sido eliminado correctamente'
        ]);

        return redirect()->route('admin.roles.index', $role);
    }
}
