<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $allRoles = config("roles.roles");
        $givenRoles = $this->get_roles($roles);
        $neededRoles = [];
        
        foreach($givenRoles as $givenRole){
            array_push($neededRoles, $allRoles[$givenRole]);
        }

        if(!in_array($request->user()->role_id, $neededRoles)){
            return redirect()->route("dashboard");
        }

        return $next($request);
    }

    public function get_roles(string $roles){
        return array_map("trim", explode(",", $roles));
    }
}
