<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Supplier;
use App\Models\Status;
use App\Models\User;
use App\Models\Vehicle;

class OrderController extends Controller
{
    public function index() // Définir la méthode pour afficher la liste des Orders
    {
        // je veut recup les
        $orders = Order::with('vehicle')->get();
        
        $users = User::all(); // Obtenir tous les utilisateurs
        $status = Status::all(); // Obtenir tous les statuts

        
        return view('orders.index', [ // Retourner la vue qui affiche la liste des orders avec les données associées
            'orders' => $orders,
            'users' => $users,
            'status' => $status
        ]);
    }

    public function create() // Définir la méthode pour créer une nouvelle order
    {
        // Obtenir tous les fournisseurs
        $suppliers = Supplier::select('id', 'label')->get();

       
        $users = User::select('id', 'name')->get(); // Obtenir tous les utilisateurs
        $status = Status::all(); // Obtenir tous les statuts

        return view('orders.create', [ // Retourner la vue qui affiche le formulaire de création de commande avec les données associées
            'users' => $users,
            'status' => $status,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request) // Définir la méthode pour enregistrer une nouvelle order
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'dateDebut' => 'required',
            'dateFin' => 'required',
            'supplier_id' => 'required',
            'vehicle_id' => 'required',
            'users_id' => 'required',
        ], [
            'firstnamed.required' => 'Le prenom est requis',
            'lastname.required' => 'Le nom est requis',
            'email.required' => 'Le mail est requis',
            'dateDebut.required' => 'Le date de début est requise',
            'dateFin.required' => 'Le date de fin est requise',
            'vehicle_id.required' => 'Le véhicule est requis',
            'supplier_id.required' => 'Le supplier est requis',
        ]);


        $order = new Order(); // Créer une nouvelle instance de Order
        $order->firstname = $request->firstname;
        $order->lastname = $request->lastname;
        $order->email = $request->email;
        $order->dateDebut = $request->dateDebut;
        $order->dateFin = $request->dateFin;
        $order->users_id = $request->users_id; // Définir l'utilisateur qui a créé la order
        $order->vehicle_id = $request->vehicle_id; // Définir le véhicule de la order
        $order->save(); // Enregistrer la order

        $vehicle = Vehicle::find($request->vehicle_id); // Obtenir le véhicule associé à la order
        $vehicle->status_id = 0; // Changer le statut du véhicule de 'disponible' (1) à 'indisponible' (2)
        $vehicle->save(); // Enregistrer le nouveau statut du véhicule

        return redirect()->route('orders.index'); // Rediriger vers la liste des orders
    }



    public function edit(Order $order)
    {
        // Récupérer tous les véhicules
        $vehicles = Vehicle::all();

        // Récupérer tous les utilisateurs
        $users = User::all();

        // Retourner la vue d'édition de order avec la order spécifique, tous les véhicules et tous les utilisateurs
        return view('orders.edit', [
            'order' => $order,
            'vehicles' => $vehicles,
            'users' => $users,
        ]);
    }

    public function update(Order $order, Request $request)
    {
        // Valider les données saisies par l'utilisateur, lesquelles doivent être de type numérique
        $validate = $request->validate([
            'vehicle_id' => 'numeric',
            'users_id' => 'numeric'
        ]);

        // Mettre à jour la order spécifiée en utilisant l'identifiant donné
        $order->update([
            'users_id' => $validate['users_id'],
            'vehicle_id' => $validate['vehicle_id'],
        ]);

        // Rediriger vers l'index des orders
        return response()->redirectToRoute('orders.index');
    }

    public function destroy($id)
    {
        // Récupérer la order spécifique en utilisant l'identifiant donné, en générant une exception s'il n'y a pas de order correspondante
        $order = Order::findOrFail($id);

        // Récupérer le véhicule associé à la order
        $vehicle = $order->vehicle;

        // Réinitialiser le statut du véhicule associé à la order
        $vehicle->status_id = 1;
        $vehicle->save();

        // Supprimer la order
        $order->delete();

        // Rediriger vers l'index des orders
        return redirect()->route('order.index');
    }
}
