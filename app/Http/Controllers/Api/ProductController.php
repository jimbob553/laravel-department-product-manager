<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Validators\ProductValidator;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Policy authorization ( can the user view any products?  )
    $this->authorize('viewAny', Product::class);

    //  Get all products (sorted)
    $products = Product::orderBy('name')->get();

    
    return response()->json($products, Response::HTTP_OK);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  Policy authorization
    $this->authorize('create', Product::class);

    //  Validate incoming data
    $validated = ProductValidator::validate($request->all());

    //  Add fields not sent by the API client
    $validated['user_id'] = $request->user()->id;

    //  Create the product --> saved in the database
    $product = Product::create($validated);

    //  Return JSON response with status 201
    return response()->json($product, Response::HTTP_CREATED);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
    //  Policy authorization
    $this->authorize('view', $product);

    
    return response()->json($product, Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    // Policy authorization
    $this->authorize('update', $product);

    //  Validate incoming data (ignore unique rule for this product’s item_number)
    $validated = ProductValidator::validate($request->all(), $product->id);

    //  Update the product with validated fields
    $product->update($validated);

    //  Return updated product as JSON
    return response()->json($product, Response::HTTP_OK);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
    //  Policy authorization
    $this->authorize('delete', $product);

    //  Delete the product
    $product->delete();

    // Return empty 204 response
    return response()->json(null, Response::HTTP_NO_CONTENT);
}
}
