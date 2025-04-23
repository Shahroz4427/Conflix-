<?php

namespace App\Repositories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Collection;

class CourtRepository implements Interfaces\CourtRepositoryInterface
{
    public function getAll(): Collection
    {
        return Court::all();
    }
}
