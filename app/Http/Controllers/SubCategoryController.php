<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategory\SubCategoryStoreRequest;
use App\Http\Requests\SubCategory\SubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::get();

        $subcategories =  SubCategory::latest()->paginate(5);
    
        return view('subcategory.index',compact('categories','subcategories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        //
        return view('subcategory.add',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStoreRequest $request)
    {
        //
        $category = Category::find($request->category_id);


    //  SubCategory::create($request->all());
   $category->subcategory()->create($request->all());


     
        return redirect()->route('subcategory.index')
                        ->with('success','SubCategory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {
        //
        return view('subcategory.show',compact('subcategory'));

    }

    // public function getSubCategory($id)
    // {
    //     //code
    //     if (Category::where('id', $id)->exists()) {
    //         $subCategory = SubCategory::where(['category_id'=> $id ] )->get();
    //         return response($subCategory, 200);
    //     } else {
    //         return response()->json([
    //             "message" => "Category not found"
    //         ], 404);
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
         
        //
        $category = Category::get();

        return view('subcategory.edit',compact('subcategory','category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory)
    {
        //
        $subCategory->update($request->all());
     return redirect()->route('subcategory.index')
                        ->with('success','SubCategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        //
        $subcategory->delete();
    
        return redirect()->route('subcategory.index')
                        ->with('success','SubCategory deleted successfully');
    }
}
