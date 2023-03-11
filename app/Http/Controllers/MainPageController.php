<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class MainPageController extends Controller
{

    public function getIndexPage()
    {
        $companies = Company::orderBy('name')->get();

        return view(
            'index',
            [
                'companies' => $companies,
            ]
        );
    }
}

?>