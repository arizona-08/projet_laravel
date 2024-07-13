<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Supplier;
use App\Models\Status;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getRoles(){
        return config("roles.roles");
    }

    public function index() // Définir la méthode pour afficher la liste des Orders
    {
        // je veut recup les
        $orders = Order::with(['vehicle', 'user', 'orderstatus'])->paginate(6);
        return view('orders.index', ['orders' => $orders]); //retourne toutes les commandes
    }

    public function create() // Définir la méthode pour créer une nouvelle order
    {

        $configRoles = $this->getRoles();
        $users = User::select('id', 'name')
            ->where("role_id", $configRoles["tenant"])
            ->get(); // Obtenir tous les utilisateurs
        $vehicles = Vehicle::where("status_id", 1)->get();
        return view('orders.create', [ // Retourner la vue qui affiche le formulaire de création de commande avec les données associées
            'users' => $users,
            'vehicles' => $vehicles
        ]);
    }


    public function store(Request $request) // Définir la méthode pour enregistrer une nouvelle order
    {

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'vehicle_id' => 'required',
            'user_id' => 'required',
        ], [
            'start_date.required' => 'Le date de début est requise',
            'end_date.required' => 'Le date de fin est requise',
            'vehicle_id.required' => 'Le véhicule est requis',
            'user_id.required' => 'L\'utilisateur est requis',
        ]);


        $order = new Order(); // Créer une nouvelle instance de Order
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->user_id = $request->user_id; // Définir l'utilisateur qui a créé la order
        $order->vehicle_id = $request->vehicle_id; // Définir le véhicule de la order
        $order->orderstatus_id = 1;
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

        // Récupérer tous les utilisateurs locataire
        $configRoles = $this->getRoles();
        $users = User::where('role_id', $configRoles["tenant"])->get(['id', 'name', 'email']);



        // Retourner la vue d'édition de order avec la order spécifique, tous les véhicules et tous les utilisateurs
        return view('orders.edit', [
            'order' => $order,
            'vehicles' => $vehicles,
            'users' => $users,
        ]);
    }

    public function update(Order $order, Request $request)
    {
        // Validate the data input by the user
        $validate = $request->validate([
            'user_id' => 'numeric|required',
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Find the user
        $user = User::find($validate['user_id']);

        if ($user) {
            // Check if the email already exists and does not belong to the current user
            $emailExists = User::where('email', $validate['email'])
                ->where('id', '!=', $user->id)
                ->exists();

            if ($emailExists) {
                return redirect()->back()->withErrors(['email' => 'L\'email est déjà utilisé.']);
            }

            // Update user's email
            $user->update(['email' => $validate['email']]);

        }

        // Update the order with the new data
        $order->update([
            'user_id' => $validate['user_id'],
            'start_date' => $validate['start_date'],
            'end_date' => $validate['end_date'],
        ]);

        // Redirect to the index of orders
        return redirect()->route('orders.index');
    }

    public function handleOrder(Request $request, Order $order){ //permet à l'admin de valider ou refuser une commande
        $order->update([
            "orderstatus_id" => $request->order_status_id
        ]);
        return redirect()->route('orders.index');
    }

    public function showOrders(){
        $user = Auth::user();
        $userOrders = Order::where("user_id", $user->id)->get();
        return view("orders.showOrders", compact("userOrders"));
    }

    public function destroy(Order $order)
    {
        // Récupérer la order spécifique en utilisant l'identifiant donné, en générant une exception s'il n'y a pas de order correspondante
        $order = $order->load('vehicle');

        // Réinitialiser le statut du véhicule associé à la order
        $order->vehicle->status_id = 1;
        $order->vehicle->save();

        // Supprimer la order
        $order->delete();

        // Rediriger vers l'index des orders
        return redirect()->route('orders.index');
    }
}
