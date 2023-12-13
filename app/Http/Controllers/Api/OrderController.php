<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Order $orders, Request $request)
    {
        $user = $request->user();

        $user_order = $orders->where('customer_id', $user->id)->get();

        return OrderResource::collection($user_order);
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
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,canceled',
            'country' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            // Add any other validation rules as needed
        ]);

        // Create the order
        $order = Order::create($request->all());

        // Associate order items
        foreach ($request->input('items') as $item) {
            $order->orderItems()->create([
                'product_variant_id' => $item['product_variant_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // // Associate coupons
        // foreach ($request->input('coupons') as $couponCode) {
        //     $coupon = Coupon::where('code', $couponCode)->first();
        //     if ($coupon) {
        //         $order->coupons()->attach($coupon->id);
        //     }
        // }

        // You may also associate payment as needed

        $order->loadMissing('orderItems.variant');


        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, Request $request)
    {
        $user = $request->user();

        if ($order->customer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order->loadMissing('orderItems.variant');

        return new OrderResource($order);
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

    // public function getOrdersByCustomer(string $customerId)
    // {
    //     $orders = Order::where('customer_id', $customerId)->get();

    //     return OrderResource::collection($orders);
    // }
}
