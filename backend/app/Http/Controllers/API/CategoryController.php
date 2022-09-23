<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categories =  CategoryResource::collection(Category::all());
            return $this->sendResponse( 'Category fetch successfully.', $categories);
        }catch(Exception $e){
            return $this->sendError($e->getMessage(), [], 500);  
        }      
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        try{
            Category::create([
                "name" => $request->input('name')
            ]);
            return $this->sendResponse( 'Category created successfully.', [], 201);
        }catch(Exception $e){
            return $this->sendError($e->getMessage(), [], 500);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        try{
            $category = new CategoryResource($category);
            return $this->sendResponse( 'Category fetch successfully.', $category, 201);
        }catch(Exception $e){
            return $this->sendError($e->getMessage(), [], 500);  
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try{
            $category->update([
                "name" => $request->input('name')
            ]);
            return $this->sendResponse( 'Category updated successfully.', [], 201);
        }catch(Exception $e){
            return $this->sendError($e->getMessage(), [], 500);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return $this->sendResponse( 'Category deleted successfully.', [], 204);
        }catch(Exception $e){
            return $this->sendError($e->getMessage(), [], 500);  
        }
    }
}
