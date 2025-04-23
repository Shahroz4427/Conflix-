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
    public function __construct(
        protected ClientRepositoryInterface $clientRepository
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clients = $this->clientRepository->getAllClientsWithPagination();

        return view('company.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('company.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        $this->clientRepository->store($request->validated());

        return redirect()->route('company.clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): View
    {
        return view('company.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): View
    {
        return view('company.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $this->clientRepository->update($client, $request->validated());

        return redirect()->route('company.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        $this->clientRepository->delete($client);
        return redirect()->route('company.clients.index')
            ->with('success', 'Client Deleted successfully.');
    }
}
