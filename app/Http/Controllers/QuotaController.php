<?php

namespace App\Http\Controllers;

use App\Models\Quota;
use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;

class QuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function show(Quota $quota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function edit(Quota $quota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuotaRequest  $request
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuotaRequest $request, Quota $quota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quota $quota)
    {
        //
    }
}
