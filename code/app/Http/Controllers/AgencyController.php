<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencies = Agency::with('user')->get();

        return view("agencies.index", ["agencies" => $agencies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $users = User::select(['id', 'name'])
            ->get();

       return view("agencies.create", ["users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
        ], [
            'label.required' => 'Le nom de l\'agence est requis',
        ]);

        Agency::create([
            'label' => $request->label,
            'user_id' => $request->user_id
        ]);

        return to_route("agencies.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        $agency->load(['vehicles', 'user'])
        ->loadCount('vehicles');
        return view("agencies.show", ["agency" => $agency]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agency $agency)
    {
        $users = User::select(['id', 'name'])->get();
        return view("agencies.edit", [
            "agency" => $agency,
            "users" => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agency $agency)
    {
        $validate = $request->validate([ // Valide les informations de la requête
            'label' => 'string',
            'user_id' => 'numeric'
        ]);

        $agency->update([ // Met à jour l'agence correspondante avec les nouvelles informations
            'label' => $validate['label'],
            'user_id' => $validate['user_id'],
        ]);
        return to_route("agencies.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();
        return to_route("agencies.index");
    }
}
