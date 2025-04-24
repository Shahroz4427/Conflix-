<?php

namespace App\Repositories;

use App\Models\CompanyConflictLetterTemplate;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyConflictLetterTemplateRepository implements Interfaces\CompanyConflictLetterTemplateRepositoryInterface
{
    /**
     * Constructor to inject the UserRepository dependency.
     * 
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * Get all conflict letter templates with pagination.
     * 
     * @param int $perPage Number of templates per page
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination(int $perPage = 10): LengthAwarePaginator
    {
        // Fetch all templates ordered by the latest and paginate the results
        return CompanyConflictLetterTemplate::latest()->paginate($perPage);
    }

    /**
     * Store a new conflict letter template.
     * 
     * @param array $data Data for the new template
     * @return CompanyConflictLetterTemplate
     */
    public function store(array $data): CompanyConflictLetterTemplate
    {
        // Upload the template file and get the file name
        $fileName = uploadFile($data['upload_template'], 'uploads/company_conflict_letter_templates');

        // Create and return the new template
        return CompanyConflictLetterTemplate::create([
            'title' => $data['title'],
            'status' => $data['status'],
            'description' => $data['description'],
            'upload_template' => $fileName,
            'uploaded_date' => now(),
            'uploaded_by' => $this->userRepository->getAuthUserName(),
        ]);
    }

    /**
     * Update an existing conflict letter template.
     * 
     * @param CompanyConflictLetterTemplate $template The template to update
     * @param array $data Data to update the template with
     * @return bool True if the update was successful, false otherwise
     */
    public function update(CompanyConflictLetterTemplate $template, array $data): bool
    {
        // Retain the existing file name
        $fileName = $template->upload_template;

        // If a new file is uploaded, replace the old file
        if (!empty($data['upload_template'])) {
            $fileName = uploadFile($data['upload_template'], 'uploads/company_conflict_letter_templates');

            // Delete the old file if it exists
            if ($template->upload_template && file_exists(public_path($template->upload_template))) {
                unlink(public_path($template->upload_template));
            }
        }

        // Update the template with the new data
        return $template->update([
            'title' => $data['title'],
            'status' => $data['status'],
            'description' => $data['description'],
            'upload_template' => $fileName,
            'uploaded_date' => now(),
            'uploaded_by' => $this->userRepository->getAuthUserName(),
        ]);
    }

    /**
     * Delete a conflict letter template.
     * 
     * @param CompanyConflictLetterTemplate $template The template to delete
     * @return bool True if the deletion was successful, false otherwise
     */
    public function delete(CompanyConflictLetterTemplate $template): bool
    {
        // Delete the uploaded file if it exists
        if ($template->upload_template && file_exists(public_path($template->upload_template))) {
            unlink(public_path($template->upload_template));
        }

        // Delete the template record from the database
        return $template->delete();
    }
}
