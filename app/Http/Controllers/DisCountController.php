<?php

namespace App\Http\Controllers;

use App\Models\DisCount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisCountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::withCount('products')->get();

        return response()->json($discounts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $discount = new DisCount;
        $discount->name = $request->input('name');
        $discount->amount = $request->input('amount');
        $discount->type_value = $request->input('type_value');
        $discount->save();

        foreach ($request->input('selectedProduct') as $index => $data) {
            $product = Product::find($data);
            $product->discount_id = $discount->id;
            $product->save();
        }
        return response()->json([
            'message' => 'Create Discount Successfully!!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $discount = DisCount::find($id);
        return response()->json($discount);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $discount = DisCount::find($id);
        $discount->name = $request->get('name');
        $discount->amount = $request->get('amount');
        $discount->type_value = $request->get('type_value');
        $discount->save();


        foreach ($request->input('selectedProduct') as $index => $data) {
            $product = Product::find($data);
            $product->discount_id = $discount->id;
            $product->save();
        }

        return response()->json([
            'message' => 'Update Discount Successfully!!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DisCount::find($id)->delete();
        return response()->json([
            'message' => 'Delete Discount Successfully!!'
        ]);
    }

    public function removediscount(string $id){
        $product = Product::find($id);
        $product->discount_id = null;
        $product->save();
        return response()->json([
            'message' => 'Remove Discount Successfully!!'
        ]);
    }
}
