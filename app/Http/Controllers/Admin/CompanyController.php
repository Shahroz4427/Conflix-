<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Constructor to inject the CompanyRepository dependency.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
    ){}

    /**
     * Display a listing of the resource.
     * 
     * @return View
     */
    public function index(): View
    {
        // Fetch all companies with pagination
        $companies = $this->companyRepository->getAllWithPagination();

        // Return the index view with the fetched companies
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        // Fetch all subscription plans for the form
        $plans = $this->companyRepository->getAllSubscriptionPlans();

        // Return the create view with the subscription plans
        return view('admin.companies.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        // Validate and store the new company
        $this->companyRepository->store($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        // Define relations to load with the company
        $relations = ['subscriptionPlan', 'user'];

        // Fetch the company with the specified relations
        $company = $this->companyRepository->findWithRelations($company, $relations);

        // Return the show view with the company details
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Company $company
     * @return View
     */
    public function edit(Company $company): View
    {
        // Fetch all subscription plans for the form
        $plans = $this->companyRepository->getAllSubscriptionPlans();

        // Fetch the company with its user relation
        $company = $this->companyRepository->findWithRelations($company, ['user']);

        // Return the edit view with the company and subscription plans
        return view('admin.companies.edit', compact('plans', 'company'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        // Validate and update the specified company
        $this->companyRepository->update($company, $request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        // Delete the specified company
        $this->companyRepository->delete($company);

        // Redirect to the index page with a success message
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    /**
     * Deactivate the specified company and its subscription plan.
     * 
     * @param Company $company
     * @return RedirectResponse
     */
    public function deactivate(Company $company): RedirectResponse
    {
        // Deactivate the company and its subscription plan
        $this->companyRepository->deactivate($company);

        // Redirect to the index page with a success message
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deactivated successfully.');
    }
}
