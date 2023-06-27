<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\User;
use App\Http\Resources\UserResource;

class ProductUserController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function show(string $id)
    {
        return new UserResource(User::findOrFail($id));
    }
}
