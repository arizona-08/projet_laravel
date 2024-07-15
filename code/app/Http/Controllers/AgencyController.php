<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{
    public function getRoles(){
        return config("roles.roles");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $configRoles = $this->getRoles();

        if ($user->role_id === $configRoles['agencyHead']) {
            $agencies = Agency::with('user')->where('user_id', $user->id)->paginate();
        } else {
            $agencies = Agency::with('user')->paginate(6);
        }

        return view("agencies.index", [
            "agencies" => $agencies,
            "user" => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $user = Auth::user();
       if($user->role_id === $this->getRoles()["agencyHead"]){
            return view("agencies.create", compact("user"));
       }

       $users = User::where("role_id", $this->getRoles()["agencyHead"])->get();
       return view("agencies.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'user_id' => 'required|exists:users,id',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required|numeric',
        ], [
            'label.required' => 'Le nom de l\'agence est requis',
            'user_id.required' => 'Le chef d\'agence est requis',
            'user_id.exists' => 'Le chef d\'agence sélectionné n\'existe pas',
            'address.required' => 'L\'adresse de l\'agence est requise',
            'city.required' => 'La ville de l\'agence est requise',
            'zip_code.required' => 'Le code postal de l\'agence est requis',
            'zip_code.numeric' => 'Le code postal de l\'agence doit être un nombre',
        ]);

        $existingAgency = Agency::where('user_id', $request->user_id)->first();
        if ($existingAgency) {
            return to_route("agencies.index")->with('error', "L'utilisateur possède déja une agence");
        } else {
            $request->validate([
                'label' => 'required',
                'user_id' => 'required|exists:users,id',
            ], [
                'label.required' => 'Le nom de l\'agence est requis',
                'user_id.required' => 'Le chef d\'agence est requis',
                'user_id.exists' => 'Le chef d\'agence sélectionné n\'existe pas',
            ]);
            
            $agency = Agency::create([
                'label' => $request->label,
                'user_id' => $request->user_id,
                'address' => $request->address,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
            ]);
            
            $user = User::find($request->user_id);
            $user->update([
                "agency_id" => $agency->id
            ]);
            return to_route("agencies.index");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        $agency->load(['vehicles.status', 'user'])
        ->loadCount('vehicles');
        return view("agencies.show", ["agency" => $agency]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agency $agency)
    {
        $configRoles = $this->getRoles();
        $users = User::where("role_id", "=", $configRoles["agencyHead"])
            ->where(function ($query) use ($agency) {
                $query->whereDoesntHave('agency')
                    ->orWhere('id', $agency->user_id);
            })
            ->get();

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
        $validate = $request->validate([
            'label' => 'string',
            'user_id' => 'numeric|exists:users,id',
            'address' => 'string',
            'city' => 'string',
            'zip_code' => 'numeric',
        ]);

        if ($agency->user_id != $request->user_id) { // Si le chef d'agence change 
            $existingAgency = Agency::where('user_id', $request->user_id)->first(); // On vérifie si le chef d'agence n'a pas déja une agence
            if ($existingAgency) { // Si il a déja une agence
                return to_route("agencies.index")->with('error', "L'utilisateur possède déja une agence");
            } // Sinon on continue
        }


        if ($agency->user_id != $request->user_id) {
            $existingAgency = Agency::where('user_id', $request->user_id)->first();
            if ($existingAgency) {
                $existingAgency->update(['user_id' => null]);
            }
            $agency->update([
                'label' => $validate['label'],
                'user_id' => $validate['user_id'],
                'address' => $validate['address'],
                'city' => $validate['city'],
                'zip_code' => $validate['zip_code'],
            ]);
        } else {
            $agency->update([
                'label' => $validate['label'],
                'address' => $validate['address'],
                'city' => $validate['city'],
                'zip_code' => $validate['zip_code'],
            ]);
        }
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
