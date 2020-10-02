<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('subscription')->paginate(12);
        return response()->json(['products' => $products]);
    }

    /**
     * Validate new product, store in db, upload image if present
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        if($request->has('image')) {
            $data['image'] = $request->file('image')->store('images/products');
        }

        $product = Product::create($data);

        return response()->json([
           'message' => 'Product successfully created',
           'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified product
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);

        if($request->has('image')) {
            $data['image'] = $request->file('image')->store('images/products');
        }

        $product->update($data);

        return response()->json([
            'message' => 'Product successfully created',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->destroy();

        return response()->noContent();
    }

    /**
     * Validate store and update requests
     * @param $request
     * @return mixed
     */
    public function validateProduct($request)
    {
        $data = $request->validate($request, [
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'price'             => 'required|integer',
            'image'             => 'sometimes|mimes:jpg,jpeg,png,svg,gif'
        ]);

        return $data;
    }
}
