<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
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
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created category in storage.
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
        return Redirect::route('categories.index')->with('message', 'Categoría agregada');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // return Inertia::render('Categories/Show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // return Inertia::render('Categories/Edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return Redirect::route('categories.index')->with('message', 'Categoría actualizada');

    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        $category->delete();
        return Redirect::route('categories.index')->with('message', 'Categoría eliminada');

    }
}
