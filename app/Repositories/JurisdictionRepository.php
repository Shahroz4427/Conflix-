<?php

namespace App\Repositories;

use App\Models\Jurisdiction;
use Illuminate\Database\Eloquent\Collection;

class JurisdictionRepository implements Interfaces\JurisdictionRepositoryInterface
{

    public function getAll(): Collection
    {
        return Jurisdiction::all();
    }
}
