<?php

namespace App\Repositories;

use App\Models\CompanyConflictLetterTemplate;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;


class CompanyConflictLetterTemplateRepository implements Interfaces\CompanyConflictLetterTemplateRepositoryInterface
{

    public function __construct(
        protected UserRepositoryInterface $userRepository
    ){}

    public function getAllWithPagination(int $perPage = 10): LengthAwarePaginator
    {
        return CompanyConflictLetterTemplate::latest()->paginate($perPage);
    }

    public function store(array $data): CompanyConflictLetterTemplate
    {
        $fileName = uploadFile($data['upload_template'], 'uploads/company_conflict_letter_templates');

        return CompanyConflictLetterTemplate::create([
            'title' => $data['title'],
            'status' => $data['status'],
            'description' => $data['description'],
            'upload_template' => $fileName,
            'uploaded_date' => now(),
            'uploaded_by' => $this->userRepository->getAuthUserName(),
        ]);
    }

    public function update(CompanyConflictLetterTemplate $template, array $data): bool
    {
        $fileName = $template->upload_template;

        if (!empty($data['upload_template'])) {
            $fileName = uploadFile($data['upload_template'], 'uploads/company_conflict_letter_templates');
            if ($template->upload_template && file_exists(public_path($template->upload_template))) {
                unlink(public_path($template->upload_template));
            }
        }

        return $template->update([
            'title' => $data['title'],
            'status' => $data['status'],
            'description' => $data['description'],
            'upload_template' => $fileName,
            'uploaded_date' => now(),
            'uploaded_by' => $this->userRepository->getAuthUserName(),
        ]);
    }

    public function delete(CompanyConflictLetterTemplate $template): bool
    {
        if ($template->upload_template && file_exists(public_path($template->upload_template))) {
            unlink(public_path($template->upload_template));
        }

        return $template->delete();
    }
}
