<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        $roles = Role::all();
        // $role_selected = DB::select('select * from model_has_roles where roles_id = ?', [1]);
        return Inertia::render('Users/Index', [
            'users' => User::all(),
            'roles' => $roles,
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'companies_id' => $request->companies_id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);
        return Redirect::route('users.index')->with('message', 'Usuario agregado');
    }

    /**
     * Update the specified User in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        
        // Asignar roles
        $user->roles()->sync($request->role);

        if ($request->change_password) {
            $user->update([
                'companies_id' => $request->companies_id,
                'name' => $request->name,
                'email' => $request->email,
                // 'role' => $request->role,
                'password' => bcrypt($request->change_password),
            ]);
        } else {
            $user->update([
                'companies_id' => $request->companies_id,
                'name' => $request->name,
                'email' => $request->email,
                // 'role' => $request->role,
            ]);
        }
        
        return Redirect::route('users.index')->with('message', 'Usuario actualizado');
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect::route('users.index')->with('message', 'Usuario eliminado');
    }
}

