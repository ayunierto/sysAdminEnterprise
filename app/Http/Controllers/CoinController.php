<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Customizer;
use App\Http\Requests\StoreCoinRequest;
use App\Http\Requests\UpdateCoinRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Coins/Index', [
            'coins' => Coin::all(),
            'perzonalizer' => Customizer::find(Auth::user()->companies_id),
            'company' => Company::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoinRequest $request)
    {
        Coin::create($request->all());
        return Redirect::route('coins.index')->with('message', 'Moneda agregada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoinRequest  $request
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoinRequest $request, $id)
    {
        $coin = Coin::find($id);
        $coin->update($request->all());
        return Redirect::route('coins.index')->with('message', 'Moneda actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coin = Coin::find($id);
        $coin->delete();
        return Redirect::route('coins.index')->with('message', 'Moneda eliminada');
    }
}
