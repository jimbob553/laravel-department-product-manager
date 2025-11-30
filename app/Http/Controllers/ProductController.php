<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Department;

/************************************************************
 *  Controller: ProductController
 *  Purpose:    Handles CRUD operations for products.
 *               - View, create, edit, update, and delete products
 *               - Ensure each product is linked to a department
 *  Notes:
 *   • Routes: /departments/{department}/products
 *   • View Files: resources/views/products/
 *   • Relationships: Product belongsTo Department
 *   • Validations: Required fields: name, price
 ************************************************************/

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of products for a given department.
     */
    public function index(Request $request, Department $department)
    {    
        if ($request->user()->cannot('viewAny', Product::class)) {
            abort(403);
        }

        // Option 1: list all products in that department
        $products = $department->products()->orderBy('name')->paginate(10);

        return view('products.index', compact('department', 'products'));
    }

    /**
     * Show the form for creating a new product under a department.
     */
    public function create(Request $request, Department $department)
    {
         if ($request->user()->cannot('create', Product::class)) {
            abort(403);
        }

        $product = new Product();

        return view('products.create', compact('department', 'product'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(ProductRequest $request, Department $department)
   {
    if ($request->user()->cannot('create', Product::class)) {
            abort(403);
        }
    //Validate and capture input data
    $data = $request->validated();

    //Auto-generate unique item number if blank
    if (empty($data['item_number'])) {
        $data['item_number'] = 'ITEM-' . strtoupper(uniqid());
    }

    //Link product to department
    $data['department_id'] = $department->id;

    $data['user_id'] = Auth::id();

    //Save the product
    $department->products()->create($data);

    //Redirect with success message
    return redirect()
        ->route('departments.show', $department)
        ->with('success', 'Product created successfully.');
}
    
    /**
     * Display the specified product.
     */
    public function show(Request $request, Department $department, Product $product)
    {   
        if ($request->user()->cannot('view', $product)) {
            abort(403);
        }

        return view('products.show', compact('department', 'product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Request $request, Department $department, Product $product)
    {   
        if ($request->user()->cannot('update', $product)) {
            abort(403);
        }

        return view('products.edit', compact('department', 'product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, Department $department, Product $product)
    {   
        if ($request->user()->cannot('update', $product)) {
            abort(403);
        }

        $data = $request->validated();

        // Preserve original item number
        $data['item_number'] = $product->item_number;

        //Keep department association in sync
        $data['department_id'] = $department->id;

        $data['user_id'] = Auth::id();
        
        $product->update($data);

        return redirect()
            ->back()
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Request $request, Department $department, Product $product)
    {
         if ($request->user()->cannot('delete', $product)) {
            abort(403);
        }

        $product->delete();

        if ($product->user_id !== Auth::id()) {
        abort(403, 'You are not authorized to delete this product.');
    }

        return redirect()
            ->route('departments.show', $department)
            ->with('success', 'Product deleted successfully.');
    }
}
