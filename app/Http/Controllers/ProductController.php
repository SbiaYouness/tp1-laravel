<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // SELECT *
    {  
        $products = Product::all(); // class::method()
    
        return response()->json([ 
            'data'    => $products, 
            'message' => 'Products retrieved successfully', 
            'count'   => $products->count(), 
        ], 200); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // INSERT
    { 
        $validated = $request->validate([ 
            'name'     => 'required|string|max:255', 
            'price'    => 'required|numeric|min:0', 
            'stock'    => 'required|integer|min:0', 
            'category' => 'nullable|string', 
        ]); 
    
        $product = Product::create($validated); 
    
        return response()->json([ 
            'data'    => $product, 
            'message' => 'Product created successfully', 
        ], 201); 
    } 

    /**
     * Display the specified resource.
     */
    public function show($id) //SELECT ID
    { 
        $product = Product::find($id); 
    
        if (!$product) { 
            return response()->json([ 
                'message' => 'Product not found', 
            ], 404); 
        } 
    
        return response()->json([ 
            'data'    => $product, 
            'message' => 'Product retrieved successfully', 
        ], 200); 
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) //UPDATE
    { 
        $product = Product::find($id); 
    
        if (!$product) { 
            return response()->json([ 
                'message' => 'Product not found', 
            ], 404); 
        } 
    
        $validated = $request->validate([ 
            'name'     => 'sometimes|string|max:255',
        'price'    => 'sometimes|numeric|min:0', 
            'stock'    => 'sometimes|integer|min:0', 
            'category' => 'nullable|string', 
        ]); 
    
        $product->update($validated); 
    
        return response()->json([ 
            'data'    => $product, 
            'message' => 'Product updated successfully', 
        ], 200); 
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) // DELETE
    { 
        $product = Product::find($id); 
    
        if (!$product) { 
            return response()->json([ 
                'message' => 'Product not found', 
            ], 404); 
        } 
    
        $product->delete(); 
    
        return response()->json([ 
            'message' => 'Product deleted successfully', 
        ], 204); 
    } 
}
