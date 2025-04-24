<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Client\StoreClientRequest;
use App\Http\Requests\Company\Client\UpdateClientRequest;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Constructor to inject the ClientRepository dependency.
     * 
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(
        protected ClientRepositoryInterface $clientRepository
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @return View
     */
    public function index(): View
    {
        // Fetch all clients with pagination
        $clients = $this->clientRepository->getAllClientsWithPagination();

        // Return the index view with the fetched clients
        return view('company.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        // Return the create view for clients
        return view('company.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreClientRequest $request
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        // Validate and store the new client
        $this->clientRepository->store($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('company.clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param Client $client
     * @return View
     */
    public function show(Client $client): View
    {
        // Return the show view with the specified client
        return view('company.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Client $client
     * @return View
     */
    public function edit(Client $client): View
    {
        // Return the edit view with the specified client
        return view('company.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        // Validate and update the specified client
        $this->clientRepository->update($client, $request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('company.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Client $client
     * @return RedirectResponse
     */
    public function destroy(Client $client): RedirectResponse
    {
        // Delete the specified client
        $this->clientRepository->delete($client);

        // Redirect to the index page with a success message
        return redirect()->route('company.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}
