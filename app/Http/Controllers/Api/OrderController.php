<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Http\Requests\EmployeeStoreRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::find($data['product_id']);
        $user = User::find($data['user_id']);
        $data['product'] = $product['name'];
        $data['name'] = $user['name'];
        $data['number'] = $user['number'];
        if(empty($data['address']))
        {
            $data['address'] = $user['address'];
        }
        if(!empty($data['employee_id']))
        {
            $employee = Employee::find($data['employee_id']);
            $data['employee'] = $employee['name'];
        }
        Order::firstOrCreate($data);
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new OrderResource(Order::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderStoreRequest $request, string $id)
    {
//        $data = User::findOrFail($id);
//        $data->fill($request->except(['id']));
//
//        $product = Product::find($data['product_id']);
//        $user = User::find($data['user_id']);
//        $data['product'] = $product['name'];
//        $data['name'] = $user['name'];
//        $data['number'] = $user['number'];
//        if(!empty($data['address']))
//        {
//            $data['address'] = $user['address'];
//        }
//        if(!empty($data['employee_id']))
//        {
//            $employee = Employee::find($data['employee_id']);
//            $data['employee'] = $employee['name'];
//        }
//
//        $data->save();
//        return response()->json($data);
        //
    }
    public function destroy(string $id)
    {
        $data = Order::findOrFail($id);
        $data->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }


}
