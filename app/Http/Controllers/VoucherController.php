<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Vouchers/Index', [
            'vouchers' => Voucher::all(),
            'company' => Company::find(Auth::user()->companies_id),
            'perzonalizer' => Customizer::find(Auth::user()->companies_id),
        ]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {
        Voucher::create($request->all());
        return Redirect::route('vouchers.index')->with('message', 'Comprobante creado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, $id)
    {
        Voucher::find($id)->update($request->all());
        return Redirect::route('vouchers.index')->with('message', 'Comprobante actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::find($id)->delete();
        return Redirect::route('vouchers.index')->with('message', 'Comprobante eliminado');
    }
}
