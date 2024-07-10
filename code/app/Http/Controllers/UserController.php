<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $role_id = $request->role_id;
        $roles = Role::where("id", $role_id)->get();
        $role = $roles[0];
        return view("users.create", compact("role"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:320'],
            'role' => ['required', 'int'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated["name"],
            'email' => $validated["email"],
            'role_id' => $validated["role"],
            'password' => password_hash($validated["password"], PASSWORD_BCRYPT),
        ]);

        return to_route("roles.index");
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
        if($user->role_id !== 1){
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:320'],
                'role' => ['required', 'int'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'role_id' => $validated["role"],
                'updated_at' => now(),
                'password' => password_hash($validated["password"], PASSWORD_BCRYPT),
            ]);
        } else {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:320'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'name' => $validated["name"],
                'email' => $validated["email"],
                'updated_at' => now(),
                'password' => password_hash($validated["password"], PASSWORD_BCRYPT),
            ]);
        }
        
        return to_route("users.show", compact("user"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('roles.index');
    }
}
