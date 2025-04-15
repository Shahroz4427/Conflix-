<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\CompanySubscriptionPlan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = Company::latest()->with(['subscriptionPlan','user'])->paginate(10);

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $plans=CompanySubscriptionPlan::all();

        return view('admin.companies.create',compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
       $data = $request->validated();
        
       $data['password'] = Hash::make($data['password']);

       $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'user_type'=>'company'
        ]);

        $data['user_id']=$user->id;

        unset($data['name'], $data['email'], $data['password']);

    
        Company::create($data);
    
    
        return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): View
    {
        $company->load(['subscriptionPlan','user']);

        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): View
    {
        $plans=CompanySubscriptionPlan::all();

        $company->load(['user']);

        return view('admin.companies.edit',compact('plans','company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();
    
        $user = $company->user;
    
        $userUpdate = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
    
        if (!empty($data['password'])) {
            $userUpdate['password'] = Hash::make($data['password']);
        }
    
        $user->update($userUpdate);
    
        unset($data['name'], $data['email'], $data['password']);
    
        $company->update($data);
    
        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }


    public function deactivate(Company $company)
    {
        $company->status = 'inactive';
        
        if ($company->subscriptionPlan) {
 
            $company->subscriptionPlan->is_active = 0;
 
            $company->subscriptionPlan->save();
        }

        $company->save();
        
        return redirect()->route('admin.companies.index')->with('success', 'Company Deactivated successfully.');
    }
    
}