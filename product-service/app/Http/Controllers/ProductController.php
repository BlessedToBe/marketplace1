<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Список всех товаров
    public function index()
    {
        return Product::all();
    }

    // Создать новый товар
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer',
            'user_id' => 'required|integer',
        ]);

        $product = Product::create($fields);
        return response()->json($product, 201);
    }

    // Показать товар по ID
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return $product;
    }

    // Обновить товар
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $fields = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric',
            'image_url' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer',
            'user_id' => 'integer',
        ]);

        $product->update($fields);
        return $product;
    }

    // Удалить товар
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
