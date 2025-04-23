<?php

namespace App\Repositories\Interfaces;

use App\Models\CompanyConflictLetterTemplate;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyConflictLetterTemplateRepositoryInterface
{
    public function getAllWithPagination(int $perPage = 10): LengthAwarePaginator;

    public function store(array $data): CompanyConflictLetterTemplate;

    public function update(CompanyConflictLetterTemplate $template, array $data): bool;

    public function delete(CompanyConflictLetterTemplate $template): bool;
}
