<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::all()->map(function ($user){
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'password' => $user->password,
                    'created_at' => substr($user->created_at, 0, 10),
                    'updated_at' => substr($user->updated_at, 0, 10),
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Inertia::render('Categories/Create');
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
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
        ]);
        return Redirect::route('users.index')->with('message', 'Usuario agregado');
    }

    /**
     * Display the specified User.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return Inertia::render('Categories/Show', compact('User'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return Inertia::render('Categories/Edit', compact('user'));
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

        if ($request->change_password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->change_password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
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
        return Redirect::route('categories.index')->with('message', 'Categoría eliminada');

    }
}

