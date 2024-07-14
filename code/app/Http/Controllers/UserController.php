<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Notifications\NewUserNotification;

class UserController extends Controller
{
    public function getRoles(){
        return config("roles.roles");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(6);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        $agencies = Agency::all();
        if ($request->has("role_id")) {
            $role_id = $request->role_id;
            $singleRole = Role::find($role_id);
            return view("users.create", compact("singleRole", "roles", "agencies"));
        }
        return view("users.create", compact("roles", "agencies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|exists:roles,id',
            'agency_id' => 'required_if:role_id,' . config('roles.roles.agencyHead') . '|exists:agencies,id',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('temporary_password'); // Mot de passe temporaire
        $user->role_id = $request->role_id;
        $user->save();

        // Si le rôle est chef d'agence, réattribuez l'agence
        if ($user->role_id == config('roles.roles.agencyHead')) {
            $agency = Agency::find($request->agency_id);

            // Si l'agence a déjà un chef d'agence, mettez à jour l'utilisateur actuel
            if ($agency->user_id) {
                $oldAgencyHead = User::find($agency->user_id);
                $oldAgencyHead->agency_id = null;
                $oldAgencyHead->save();
            }

            $agency->user_id = $user->id;
            $agency->save();
        }

        // Generate password reset token
        $token = Password::createToken($user);

        // Send notification to set password
        $user->notify(new NewUserNotification($user, $token));

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès et notification envoyée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $configRoles = $this->getRoles();
        switch ($user->role_id) {
            case $configRoles["admin"]:
            case $configRoles["agencyHead"]:
                $user->load(["role", "agencies"]);
                break;
            case $configRoles["supplierManager"]:
            case $configRoles["orderManager"]:
            case $configRoles["tenant"]:
                $user->load("role");
                break;
            default:
                return "Role inexistant";
        }

        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $agencies = Agency::all();
        $configRoles = $this->getRoles();
        $allAdmins = User::where("role_id", $configRoles["admin"])->get();
        $allAdminsCount = $allAdmins->count();
        return view("users.edit", compact("user", "roles", "allAdminsCount", "agencies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $configRoles = $this->getRoles();
        $user = User::findOrFail($user->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:320', "unique:users,email,{$user->id}"],
            'role' => ['required', 'int', 'exists:roles,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($user->role_id !== $configRoles["admin"]) {
            $user->update([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'role_id' => $validated["role"],
                'updated_at' => now(),
                'password' => Hash::make($validated["password"]),
            ]);
        } else {
            $user->update([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'updated_at' => now(),
                'password' => Hash::make($validated["password"]),
            ]);
        }

        return redirect()->route('users.show', compact("user"))->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
