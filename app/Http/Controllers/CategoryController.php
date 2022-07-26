<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::all()->map(function ($category){
                return [
                    'id' => $category->id,
                    'company' => Company::find($category->companies_id)->name,
                    'name' => $category->name,
                    'description' => $category->description,
                ];
            }),
            'companies' => Company::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'companies_id' => $request->company['id'],
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return Inertia::render('Categories/Index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // return Inertia::render('Categories/Show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $category::update($request->validate());
        return Redirect::route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $flight = Flight::find(1);
 
        // $flight->delete();

        // return $id;
        $category = Category::find($id);
        $category->delete();
        return Redirect::route('categories.index')->with('message', 'Categoría Eliminada');

    }
}
