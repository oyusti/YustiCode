<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::Paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if($request->password != null){
            $user->update ([
                'password' => bcrypt($request->password)
            ]);
        }

        $user->roles()->sync($request->roles);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Bien Hecho',
            'text'  => 'El usuario se ha actualizado correctamente'
        ]);

        return redirect()->route('admin.users.index', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
