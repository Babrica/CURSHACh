<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use http\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function category($category)
    {
        $category_ = Product::where('category', $category)->get();
        if(!empty($category_))
        {
            return $category_;
        }
        else
        {
            abort(404, 'Category not found');
        }
    }

    public function store(ProductStoreRequest $request)
    {
        $created_product = $request->validated();
//        $created_product = Product::create($request->validated());
//        $img = $created_product['img'];
//        Storage::put('/images', $img);
        $created_product['img'] = Storage::put('/images', $created_product['img']);
        Product::firstOrCreate($created_product);
        return $created_product;
    }

    public function show(string $id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function update(ProductStoreRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->except(['id']));
        $product->save();
        return response()->json($product);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }


}
