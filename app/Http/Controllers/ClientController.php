<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        // Fetch states and cities for filter dropdowns
        $states = Client::pluck('state')->unique()->values()->all();
        $cities = Client::pluck('city')->unique()->values()->all();
    
        // Pass the clients and filter options data to the view for display
        return view('index', compact('clients', 'states', 'cities'));
    }

    public function create()
    {
        // Fetch states and cities for autosuggest
        $states = Client::pluck('state')->unique()->values()->all();
        $cities = Client::pluck('city')->unique()->values()->all();

        return view('create', compact('states', 'cities'));
    }

    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'nullable|email',
            'address' => 'nullable',
            'password' => 'required|confirmed',
        ]);

        // Store the client in the database
        Client::create($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }
    public function update(Request $request, Client $client)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6', // Adjust validation rules as needed
        ]);

        // Update the client with the validated data
        $client->update($validatedData);

        return dd($request);
        // return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

}
