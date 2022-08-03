<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('Dashboard', [
            'products' => Product::where('companies_id', $company_id)->count(),
            'company' => Company::find( $company_id ),
        ]);
    }
}
