<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {

        // $products = Product::query()->orderBy('id', 'desc')->get();
        // foreach ($products as $product) {
        //     echo "<p>{$product->title} | {$product->category->title} | {$product->status->title} {</p>";
        // }
        // return view('products.index');


        // $products = Product::query()->with(['category', 'status'])->orderBy('id', 'desc')->get();
        // foreach ($products as $product) {
        //     echo "<p>{$product->title} | {$product->category->title} | {$product->status->title} {</p>";
        // }
        // return view('products.index');


        $title = 'Home Page';
        $products = Product::with(['category', 'status'])->orderBy('id', 'desc')->paginate(3);
        return view('products.index', compact('title', 'products'));
    }

    public function show($slug)
    {
        dd($slug);
    }
}
