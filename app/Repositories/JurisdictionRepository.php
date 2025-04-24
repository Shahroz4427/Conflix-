<?php

namespace App\Repositories;

use App\Models\Jurisdiction;
use Illuminate\Database\Eloquent\Collection;

class JurisdictionRepository implements Interfaces\JurisdictionRepositoryInterface
{
    /**
     * Get all jurisdictions.
     * 
     * @return Collection
     */
    public function getAll(): Collection
    {
        // Fetch and return all jurisdictions
        return Jurisdiction::all();
    }
}
