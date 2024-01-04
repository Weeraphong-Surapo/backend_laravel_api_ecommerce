<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->cost = $request->input('cost');
        $product->quantity = $request->input('quantity');
        $product->address_stock = $request->input('address_stock');
        $product->barcode = $request->input('barcode');
        $product->category_id = $request->input('category');

        if ($request->hasFile('file') && $request->file('file') != null) {
            $file = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $product->image = 'storage/' . $filePath;
        }
        $product->save();
        return response()->json([
            'message' => 'Create Product Successfully',
            'file' => $request->file('file')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ProductResource(Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // return response()->json([
        //     'data' => $request->all(),
        //     'id' => $id
        // ]);
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->cost = $request->get('cost');
        $product->quantity = $request->get('quantity');
        $product->address_stock = $request->get('address_stock');
        $product->barcode = $request->get('barcode');
        $product->category_id = $request->get('category');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $product->image = 'storage/' . $filePath;
        }
        $product->save();
        return response()->json([
            'message' => 'Update Product Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
            if ($product->delete()) {
                return response()->json([
                    'message' => 'Product Delete Successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Cannot Delete Product'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Product Not Found'
            ], 404);
        }
    }
}
