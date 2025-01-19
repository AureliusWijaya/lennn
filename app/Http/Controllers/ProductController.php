<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\category;
use App\Models\order;
use App\Models\orderitem;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index()
    {
        return view('create');
    }
    public function showAll()
    {
        $articles = product::all();
        return view('welcome', compact('articles'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|mimes:jpeg,png',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $imageName);
        product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $imageName,
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('home')->with('success', 'Article uploaded successfully');


    }

    public function show($id)
    {
        $product = product::findOrFail($id);
        $categories = category::all();
        return view('edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|mimes:jpeg,png',
        ]);

        $product = product::findOrFail($id);

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // ini save di public/images
            // kalo folder images blm kebuat auto kebuat
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }

            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('home')->with('success', 'Article updated successfully');
    }

    public function delete($id)
    {
        $product = product::findOrFail($id);
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->delete();
        return redirect()->route('home')->with('success', 'Article deleted successfully');
    }

    public function productDetail($id)
    {
        $product = product::findOrFail($id);
        return view('product', compact('product'));
    }

    public function purchase(Request $request, $productId)
    {
        // Validate the request input
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = product::findOrFail($productId);

        $quantity = $validated['quantity'];
        $totalPrice = $product->price * $quantity;

        DB::transaction(function () use ($product, $quantity, $totalPrice) {
            $order = order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
            ]);

            orderitem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        });

        return redirect()->route('home')->with('success', 'Purchase successful!');
    }
}
