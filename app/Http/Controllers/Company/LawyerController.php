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

    public function __construct(
        protected LawyerRepositoryInterface $lawyerRepository
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $relations=['jurisdiction'];

        $lawyers = $this->lawyerRepository->getAllLawyersWithRelationAndPagination($relations);

        return view('company.lawyers.index', compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jurisdictions = $this->lawyerRepository->getAllJurisdiction();

        return view('company.lawyers.create', compact('jurisdictions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLawyerRequest $request): RedirectResponse
    {
        $this->lawyerRepository->store($request->validated());

        return redirect()->route('company.lawyers.index')
            ->with('success', 'Lawyer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lawyer $lawyer): View
    {
        $relations=['jurisdiction'];

        $this->lawyerRepository->loadRelations($relations, $lawyer);

        return view('company.lawyers.show', compact('lawyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lawyer $lawyer): View
    {
        $relations=['jurisdiction'];

        $jurisdictions = $this->lawyerRepository->getAllJurisdiction();

        $this->lawyerRepository->loadRelations($relations, $lawyer);

        return view('company.lawyers.edit', compact('lawyer', 'jurisdictions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLawyerRequest $request, Lawyer $lawyer): RedirectResponse
    {
        $this->lawyerRepository->update($request->validated(),$lawyer);

        return redirect()->route('company.lawyers.index')
            ->with('success', 'Lawyer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lawyer $lawyer): RedirectResponse
    {
        $this->lawyerRepository->delete($lawyer);

        return redirect()->route('company.lawyers.index')
            ->with('success', 'Lawyer Deleted successfully.');
    }
}
