<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Vehicle;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(6);
        return view("suppliers.index", ["suppliers" => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("suppliers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
        ], [
            'label.required' => 'Le nom du fournisseur est requis',
        ]);
        // Créer un nouvel objet fournisseur
        $suppliers = new Supplier();

        // Affecter la valeur du champ 'label' à partir de la requête reçue
        $suppliers->label = $request->label;

        // Enregistrer le fournisseur dans la base de données
        $suppliers->save();

        // Rediriger l'utilisateur vers la page des fournisseurs
        return response()->redirectToRoute('suppliers.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Récupérer le fournisseur à partir de son id
        $suppliers = Supplier::find($id);

        // Retourne la vue fournisseur/edit avec le fournisseur récupéré
        return view('suppliers.edit', ['suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validation de la requête
        $validate = $request->validate([
            'label' => 'required|string',
        ]);

        // mise à jour des informations de fournisseur
        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'label' => $validate['label'],
        ]);

        // redirection avec un message de succès
        return redirect()->route('suppliers.index')->with('success', 'Fournisseur mis à jour avec succès');
    }

    public function show($id, Request $request)
    {
        // Commencer la requête de base
        $query = Vehicle::where('supplier_id', $id);

        // Filtrage par marque
        if ($request->filled('brand')) {
            $query->where('marque', $request->brand);
        }

        // Tri par kilométrage
        if ($request->filled('sort_km')) {
            $query->orderBy('nb_kilometrage', $request->sort_km);
        }

        // Pagination
        $vehicles = $query->paginate(6);

        // Récupérer les marques pour le filtre
        $brands = Vehicle::select('marque')->distinct()->get();

        $supplier = Supplier::findOrFail($id);

        // Retourne la vue suppliers/show avec le fournisseur et ses véhicules
        return view('suppliers.show', [
            'supplier' => $supplier,
            'vehicles' => $vehicles,
            'brands' => $brands
        ]);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        // On redirige l'utilisateur vers la liste des véhicules
        return redirect()->route('suppliers.index');
    }
}
