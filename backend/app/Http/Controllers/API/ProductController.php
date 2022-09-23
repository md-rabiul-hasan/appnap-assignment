<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products =  ProductResource::collection(Product::all());
            return $this->sendResponse('Product fetch successfully.', $products);
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
    public function store(Request $request)
    {
        $uploadFolder = 'product-images';
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        
        try{
            Product::create([
                "category_id" => $request->input('category_id'),
                "user_id"     => Auth::user()->id,
                "name"        => $request->input('name'),
                "price"       => $request->input('price'),
                "image"       => "public/storage/{$uploadFolder}/{$image_uploaded_path}"
            ]);
            return $this->sendResponse( 'Product created successfully.', [], 201);
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
    public function show(Product $product)
    {
        try{
            $product = new ProductResource($product);
            return $this->sendResponse( 'Product fetch successfully.', $product, 201);
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
    public function update(Request $request, Product $product)
    {
      
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productUpdate(Request $request, $id){
        $product = Product::find($id);

 
        if($request->has('image')){
            $uploadFolder = 'product-images';
            $image = $request->file('image');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $image_path = "public/storage/{$uploadFolder}/{$image_uploaded_path}";
        }else{
            $image_path = $product->image; // old image path cannot be changed
        }
        
        try{
            Product::where('id', $id)->update([
                "category_id" => $request->input('category_id'),
                "user_id"     => Auth::user()->id,
                "name"        => $request->input('name'),
                "price"       => $request->input('price'),
                "image"       => $image_path
            ]);
            return $this->sendResponse( 'Product updated successfully.', [], 201);
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
    public function destroy(Product $product)
    {
        if($product->user_id != Auth::user()->id){ // check product owner ship
            return $this->sendError("Only owner can delete her product", [], 401);  
        }

        try{
            $product->delete();
            return $this->sendResponse( 'Product deleted successfully.', [], 200);
        }catch(Exception $e){
            return $this->sendError($e->getMessage(), [], 500);  
        }

    }
}
