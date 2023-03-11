<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCompanyRequest;
use App\Models\Company;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function getCompanyPage($id)
    {
        $company = Company::find($id);
        $fields = Field::select('field', 'readable')->get();

        return view(
            'company',
            [
                'company' => $company,
                'fields' => $fields,
            ]
        );
    }

    public function addCompany(AddCompanyRequest $request)
    {
        $validated = $request->validated();

        Company::insertGetId($validated);

        return redirect()->route('home');
    }

    public function delCompany()
    {
        if (Auth::user()){
            $company_id = request()->all()['company_id'];
            Company::find($company_id)->delete();
        }

        return redirect()->route('home');
    }
}