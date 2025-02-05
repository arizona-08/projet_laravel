<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Status;
use App\Models\Supplier;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function getRoles(){
        return config("roles.roles");
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehicle::with(['agency', 'status']);

        // Filter by brand
        if ($request->has('brand') && $request->brand != '') {
            $query->where('marque', $request->brand);
        }

        // Sort by kilometers
        if ($request->has('sort_km') && in_array($request->sort_km, ['asc', 'desc'])) {
            $query->orderBy('nb_kilometrage', $request->sort_km);
        }

        $vehicles = $query->paginate(6);

        // Get all unique brands for the filter dropdown
        $brands = Vehicle::select('marque')->distinct()->get();

        return view('vehicles.index', ['vehicles' => $vehicles, 'brands' => $brands]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Agency $agency = null)
    {
        $status = Status::select(['id', 'label'])->get();
        $agencies = Agency::select(['id', 'label'])->get();
        $suppliers = Supplier::select(['id', 'label'])->get();
        
        if($agency !== null){
            $agencies = Agency::where("id", $agency->id)->get(); //utilisation de where voulue pour récupérer un tableau même s'il a qu'une seule valeur
        }

        return view("vehicles.create", compact('status','agencies', 'suppliers')); //compact() renvoie un tableau associatif
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'last_maintenance' => 'required',
            'nb_kilometrage' => 'required',
            'nb_serie' => 'required',
            'status_id' => 'required',
            'agency_id' => 'required',
            'supplier_id' => 'required',
            'price_per_day' => 'required',
        ], [
            'marque.required' => 'La marque est requise',
            'model.required' => 'Le modèle est requis',
            'last_maintenance.required' => 'La dernière maintenance est requise',
            'nb_kilometrage.required' => 'Le nombre de kilométrage est requis',
            'nb_serie.required' => 'Le numero de série est requis',
            'status_id.required' => 'Le statut est requis',
            'agency_id.required' => 'Le nom de l\'agence est requis',
            'supplier_id.required' => 'Le nom du fournisseur est requis',
            'price_per_day.required' => 'Le prix par jour est requis',
        ]);
        // On crée un nouveau véhicule avec les données récupérées du formulaire
        Vehicle::create([
            'model' => $request->model,
            'marque' => $request->marque,
            'last_maintenance' => $request->last_maintenance,
            'nb_kilometrage' => $request->nb_kilometrage,
            'nb_serie' => $request->nb_serie,
            'status_id' => $request->status_id,
            'agency_id' => $request->agency_id,
            'supplier_id' => $request->supplier_id,
            'price_per_day' => $request->price_per_day,

        ]);

        
        //redirige vers l'agence du véhicule crée en fonction du role de l'utilisateur
        $user = Auth::user();
        $roles = $this->getRoles();
        $wantedRoles = [$roles["agencyHead"], $roles["admin"]];
        if(in_array($user->role_id, $wantedRoles)){
            $agency = Agency::find($request->agency_id);
            return redirect()->route("agencies.show", compact("agency"));
        }
        // On redirige l'utilisateur vers la liste des véhicules
        return redirect()->route('vehicles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $status = Status::select(['id', 'label'])->get();
        $suppliers = Supplier::select(['id', 'label'])->get();
        $agencies = Agency::select(['id', 'label'])->get();
        return view("vehicles.edit", compact("vehicle", "status", "suppliers", "agencies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        // Valide les données de la requête
        $validate = $request->validate([
            'model' => 'string',
            'marque' => 'string',
            'last_maintenance' => 'date',
            'nb_kilometrage' => 'string',
            'nb_serie' => 'string',
            'status_id' => 'numeric',
            'agency_id' => 'numeric',
            'supplier_id' => 'numeric',
            'price_per_day' => 'numeric',
        ]);

        // Met à jour les données de véhicule avec les données validées
        $vehicle->update([
            'model' => $validate['model'],
            'marque' => $validate['marque'],
            'last_maintenance' => $validate['last_maintenance'],
            'nb_kilometrage' => $validate['nb_kilometrage'],
            'nb_serie' => $validate['nb_serie'],
            'status_id' => $validate['status_id'],
            'agency_id' => $validate['agency_id'],
            'supplier_id' => $validate['supplier_id'],
            'price_per_day' => $validate['price_per_day'],
        ]);

        // On redirige l'utilisateur vers la liste des véhicules
        return redirect()->route('vehicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {

        $vehicle->load(['agency', 'status', 'supplier']);
        return view('vehicles.show', compact('vehicle'));
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        // On redirige l'utilisateur vers la liste des véhicules
        return redirect()->route('vehicles.index');
    }

    public function getVehiclesBySupplier($supplierId)
    {
        // Obtenir les véhicules disponibles pour le fournisseur donné
        $vehicles = Vehicle::where('supplier_id', $supplierId)
            ->select('id', 'model', 'marque', 'supplier_id')
            ->get();

        // Retourner les véhicules au format JSON

        return response()->json($vehicles);
    }
}
