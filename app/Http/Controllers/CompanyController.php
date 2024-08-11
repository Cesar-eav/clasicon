<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function create()
    {
        return Inertia::render('Company/Create');
    }

    public function edit()
    {
        return Inertia::render('Company/Edit');
    }

    public function index()
    {
        $companies = Company::paginate(5);
        return Inertia::render('Company/Index',compact('companies'));
    }

    public function store(Request $request)
    {
        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'rut' => $request->rut
        ]);

        return redirect()->back()->with('success', 'Capsule added.');
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->update($request->all());

        return redirect()->back()->with('success', 'Capsule edited.');
    }

    public function delete($id)
    {
        Company::find($id)->delete();

        return redirect()->back()->with('success', 'Capsule deleted.');
    }

    public function list()
    {
        return Company::pluck('id','name')->toArray();
    }
}
