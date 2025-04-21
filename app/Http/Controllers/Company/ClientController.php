<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use App\Http\Requests\Company\Client\StoreClientRequest;
use App\Http\Requests\Company\Client\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $clients = Client::where('company_id', auth()->user()->company->id)->latest()->paginate(10);

        return view('company.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();

        $company = auth()->user()->company;
        
        $validated['company_id'] = $company->id;

        Client::create($validated);

        $company->increment('total_clients');

        return redirect()->route('company.clients.index')->with('success', 'Client created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('company.clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('company.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validated = $request->validated();
    
        if ($client->company_id !== auth()->user()->company->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $client->update($validated);
    
        return redirect()->route('company.clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        auth()->user()->company->decrement('total_clients');

        return redirect()->route('company.clients.index')->with('success', 'Client Deleted successfully.');
    }
}