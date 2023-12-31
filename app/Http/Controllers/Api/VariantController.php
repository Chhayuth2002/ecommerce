<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VariantCollection;
use App\Http\Resources\VariantResource;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $variants = ProductVariant::where('parent_id', null)->get();
        $productVariant = ProductVariant::with('productAttributes.attribute', 'productAttributes.option')->get();

        return  VariantResource::collection($productVariant);
    }

    // public function productVariant()
    // {
    //     $variants = ProductVariant::where('parent_id', null)->get();

    //     return  VariantResource::collection($variants);
    // }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $variant)
    {
        return new VariantResource($variant);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
