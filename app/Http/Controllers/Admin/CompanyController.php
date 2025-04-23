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
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = $this->companyRepository->getAllWithPagination();

        return view('admin.companies.index',
            compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $plans = $this->companyRepository->getAllSubscriptionPlans();

        return view('admin.companies.create',
            compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $this->companyRepository->store($request->validated());

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): View
    {
        $relations=['subscriptionPlan', 'user'];

        $company = $this->companyRepository->findWithRelations($company, $relations);

        return view('admin.companies.show',
            compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): View
    {
        $plans = $this->companyRepository->getAllSubscriptionPlans();

        $company = $this->companyRepository->findWithRelations($company, ['user']);

        return view('admin.companies.edit',
            compact('plans', 'company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $this->companyRepository->update($company, $request->validated());

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        $this->companyRepository->delete($company);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    /**
     * Deactivate Company as well as its subscription plan.
     */
    public function deactivate(Company $company): RedirectResponse
    {
        $this->companyRepository->deactivate($company);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deactivated successfully.');
    }
}
