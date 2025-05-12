<?php

namespace App\Repositories\Product;

use App\Interface\Products\ProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $products->makeHidden(['created_at', 'updated_at']);
        
        return response()->json([
            'products' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => round($request->price, 2),
                'stock_quantity' => $request->stock_quantity
            ]);

            // Price Product Alogorithm
            if ($product->stock_quantity < 5) {
                $product->price *= 1.10; // 10% increase
                $product->save();
            }elseif ($product->stock_quantity > 20) {
                $product->price *= 0.90; // 10% discount
                $product->save();
            }

            // Hide created_at and updated_at
            $product->makeHidden(['created_at', 'updated_at']);

            // Round price
            $product->price = round($product->price, 2);
            
            DB::commit();
            return response()->json([
                'product' =>  $product
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            // $product->makeHidden(['created_at', 'updated_at']);
            if(!$product) {
                return response()->json([
                    'message' => 'Product not found'
                ], 404);
            }
            return response()->json([
                'product' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity
            ]);


            // Price Product Alogorithm
            if ($product->stock_quantity < 5) {
                $product->price *= 1.10; // 10% increase
                $product->save();
            }elseif ($product->stock_quantity > 20) {
                $product->price *= 0.90; // 10% discount
                $product->save();
            }

            // Hide created_at and updated_at
            $product->makeHidden(['created_at', 'updated_at']);

            // Round price
            $product->price = round($product->price, 2);

            DB::commit();
            return response()->json([
                'product' =>  $product
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}