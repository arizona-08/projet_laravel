<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Notifications\NewUserNotification;

class UserController extends Controller
{
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
        if($request->has("role_id")){
            $role_id = $request->role_id;
            $roles = Role::where("id", $role_id)->get();
            $singleRole = $roles[0];
            return view("users.create", compact("singleRole"));
        }

        $roles = Role::all();
        return view("users.create", compact("roles"));
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
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('temporary_password'); // Mot de passe temporaire
        $user->role_id = $request->role_id;
        $user->save();

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
       switch($user->role_id){
        case 1:

        case 2:
            $user->load("role");
            break;

        case 3:
            $user->load(["role", "agencies"]);
            break;

        case 4:
            $user->load("role");
            break;

        case 5:
            $user->load("role");

            break;
        default:
            return "Role inexistant";
            break;
       }

       return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if($user->role_id === 1){
            $roles = Role::all();
        }else {
            $roles = Role::where("id", ">", 1)->get();
        }

        return view("users.edit", compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        if($user->role_id !== 1){
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:320', "unique:users,email,{$user->id}"],
                'role' => ['required', 'int', 'exists:roles,id'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'role_id' => $validated["role"],
                'updated_at' => now(),
                'password' => Hash::make($validated["passwod"]),
            ]);
        } else {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:320', "unique:users,email,{$user->id}"],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'updated_at' => now(),
                'password' => Hash::make($validated["passwod"]),
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|',
        ]);

        // $user->name = $request->name;
        // $user->email = $request->email;
        // if ($request->filled('password')) {
        //     $user->password = Hash::make($request->password);
        // }
        // $user->role_id = $request->role_id;
        // $user->save();

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
