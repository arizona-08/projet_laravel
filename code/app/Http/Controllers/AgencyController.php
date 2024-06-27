<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencies = DB::table('agencies')
            ->join('users', 'agencies.agency_id', "=", "users.user_id")
            ->select('agencies.label', 'users.name')
            ->get();

        return view("agencies.index", ["agencies" => $agencies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("agencies.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return to_route("agencies.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        return view("agencies.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agency $agency)
    {
        return view("agencies.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agency $agency)
    {
        return to_route("agencies.edit", ["agency", $agency]);
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
