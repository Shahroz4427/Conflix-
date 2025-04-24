<?php

namespace App\Repositories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Collection;

class CourtRepository implements Interfaces\CourtRepositoryInterface
{
    /**
     * Get all courts.
     * 
     * @return Collection
     */
    public function getAll(): Collection
    {
        // Fetch and return all courts
        return Court::all();
    }
}
