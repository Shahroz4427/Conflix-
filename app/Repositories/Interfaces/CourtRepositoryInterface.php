<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CourtRepositoryInterface
{
    public function getAll(): Collection;
}
