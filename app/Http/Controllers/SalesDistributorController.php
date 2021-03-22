<?php

namespace App\Http\Controllers;

use App\Models\SalesDistributor;
use Illuminate\Http\Request;

class SalesDistributorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salesDistributors = SalesDistributor::all();

        return view('sales_distributor.index', compact('salesDistributors'));
    }
}
