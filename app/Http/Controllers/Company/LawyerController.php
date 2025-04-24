<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Lawyer\StoreLawyerRequest;
use App\Http\Requests\Company\Lawyer\UpdateLawyerRequest;
use App\Models\Lawyer;
use App\Repositories\Interfaces\LawyerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LawyerController extends Controller
{
    /**
     * Constructor to inject the LawyerRepository dependency.
     * 
     * @param LawyerRepositoryInterface $lawyerRepository
     */
    public function __construct(
        protected LawyerRepositoryInterface $lawyerRepository
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @return View
     */
    public function index(): View
    {
        // Define the relations to load with each lawyer
        $relations = ['jurisdiction'];

        // Fetch all lawyers with the specified relations and pagination
        $lawyers = $this->lawyerRepository->getAllLawyersWithRelationAndPagination($relations);

        // Return the index view with the fetched lawyers
        return view('company.lawyers.index', compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        // Fetch all jurisdictions for the form
        $jurisdictions = $this->lawyerRepository->getAllJurisdiction();

        // Return the create view with the fetched jurisdictions
        return view('company.lawyers.create', compact('jurisdictions'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreLawyerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLawyerRequest $request): RedirectResponse
    {
        // Validate and store the new lawyer
        $this->lawyerRepository->store($request->validated());

        // Redirect to the index page with a success message
        return redirect()->route('company.lawyers.index')
            ->with('success', 'Lawyer created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param Lawyer $lawyer
     * @return View
     */
    public function show(Lawyer $lawyer): View
    {
        // Define the relations to load with the lawyer
        $relations = ['jurisdiction'];

        // Load the specified lawyer with the defined relations
        $this->lawyerRepository->loadRelations($relations, $lawyer);

        // Return the show view with the lawyer details
        return view('company.lawyers.show', compact('lawyer'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Lawyer $lawyer
     * @return View
     */
    public function edit(Lawyer $lawyer): View
    {
        // Define the relations to load with the lawyer
        $relations = ['jurisdiction'];

        // Fetch all jurisdictions for the form
        $jurisdictions = $this->lawyerRepository->getAllJurisdiction();

        // Load the specified lawyer with the defined relations
        $this->lawyerRepository->loadRelations($relations, $lawyer);

        // Return the edit view with the lawyer and jurisdictions
        return view('company.lawyers.edit', compact('lawyer', 'jurisdictions'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateLawyerRequest $request
     * @param Lawyer $lawyer
     * @return RedirectResponse
     */
    public function update(UpdateLawyerRequest $request, Lawyer $lawyer): RedirectResponse
    {
        // Validate and update the specified lawyer
        $this->lawyerRepository->update($request->validated(), $lawyer);

        // Redirect to the index page with a success message
        return redirect()->route('company.lawyers.index')
            ->with('success', 'Lawyer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Lawyer $lawyer
     * @return RedirectResponse
     */
    public function destroy(Lawyer $lawyer): RedirectResponse
    {
        // Delete the specified lawyer
        $this->lawyerRepository->delete($lawyer);

        // Redirect to the index page with a success message
        return redirect()->route('company.lawyers.index')
            ->with('success', 'Lawyer deleted successfully.');
    }
}
