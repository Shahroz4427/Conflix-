<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface JurisdictionRepositoryInterface
{
    public function getAll(): Collection;
}
