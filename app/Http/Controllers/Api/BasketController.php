<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketStoreRequest;
use App\Http\Resources\BasketResource;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Employee;
use App\Models\Order;

class BasketController extends Controller
{
    public function index()
    {
        return BasketResource::collection(Basket::all());
    }

    public function store(BasketStoreRequest $request)
    {
        $data = $request->validated();
        Basket::firstOrCreate($data);
        return $data;
    }

    public function show(string $id)
    {
//        return new BasketResource(Basket::where('user_id', $id)->get());
        $data = Basket::where('user_id', $id)->get();
        return $data;
    }

    public function update(BasketStoreRequest $request, string $id)
    {
        $data = Basket::findOrFail($id);
        $data->fill($request->except(['id']));
        $data->save();
        return response()->json($data);
    }

    public function destroy(string $id)
    {
        $data = Basket::findOrFail($id);
        $data->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

//    public function order(string $id)
//    {
//        $order = Basket::where('user_id', $id)->get();
//        $employee = Employee::where('active', 1)->first();
//        if(empty($employee))
//        {
//
//        }
//
//        $data = Order::find($id);
//        $data->fill($request->except(['id']));
//        $employee = Employee::find($data['employee_id']);
//        $data['employee'] = $employee['name'];
//
//        if($employee['active'] === 1)
//        {
//            return response()->json(['errors', 'Данный сотрудник занят']);
//        }
//        else
//        {
//            $employee['active'] = 1;
//            $employee['order_id'] = $id;
//            $employee->save();
//            $data->save();
//            return [$employee, $data];
//        }
//    }
}
