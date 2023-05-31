<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Order;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeStoreRequest1;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    public function index()
    {
        return Employee::all();
    }

    public function store(EmployeeStoreRequest $request)
    {
        $data = $request->validated();
        Employee::firstOrCreate($data);
        return $data;
    }

    public function show(string $id)
    {
        return new EmployeeResource(Employee::findOrFail($id));
    }

    public function update(EmployeeStoreRequest1 $request, string $id)
    {
        $data = Employee::findOrFail($id);
        $data->fill($request->except(['id']));
        $data->save();
        return response()->json($data);
    }

    public function destroy(string $id)
    {
        $data = Employee::findOrFail($id);
        $data->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function setEmployee(EmployeeStoreRequest1 $request, string $id)
    {
        $data = Order::find($id);
        $data->fill($request->except(['id']));
        $employee = Employee::find($data['employee_id']);
        $data['employee'] = $employee['name'];

        if($employee['active'] === 1)
        {
            return response()->json(['errors', 'Данный сотрудник занят']);
        }
        else
        {
            $employee['active'] = 1;
            $employee['order_id'] = $id;
            $employee->save();
            $data->save();
            return [$employee, $data];
        }
    }

    public function unEmployee(Request $request, string $id)
    {
        $employee = Employee::find($id);
        $order = Order::find($employee['order_id']);
        $order['employee'] = null;
        $order['employee_id'] = null;
        $order->save();

        $employee['active'] = 0;
        $employee['order_id'] = null;
        $employee->save();
        return [$order, $employee];
    }
}
