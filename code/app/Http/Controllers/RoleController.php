<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::select(['id','name'])
        ->withCount('users')
        ->get();

        return view('roles.index', compact('roles'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('users')
        ->loadCount('users');
        return view("roles.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view("roles.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            "name" => ["required", "string", "max:80"]
        ]);

        $role->update([
            "name" => $request->name
        ]);

        return to_route("roles.show", compact("role"));
    }
}
