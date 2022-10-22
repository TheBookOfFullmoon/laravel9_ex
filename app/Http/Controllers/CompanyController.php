<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::latest()->paginate(5);

        return view('companies.index', compact('companies'));
    }

    public function create(){
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request){
        Company::create($request->post());

        return redirect()->route('companies.index')
            ->with('success', 'Company has been created successfully.');
    }

    public function show(Company $company){
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company){
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company){

        $company->update($request->post());

        return redirect()->route('companies.index')
            ->with('success', 'Company has been updated successfully.');
    }

    public function destroy(Company $company){
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company has been deleted successfully.');
    }
}
