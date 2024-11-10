<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Enums\DeliveryType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|unique:orders|max:255',
            'weight' => 'required|numeric|min:0.1',
            'city' => 'required|string|max:255',
            'delivery_type' => 'required|in:' . implode(',', DeliveryType::values()),
            'address'=>'required|string|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        $order = Order::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Замовлення успішно створене!',
            'order_id' => $order->id,
        ], 201);
    }
}
