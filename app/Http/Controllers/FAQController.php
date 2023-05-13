<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    // Index
    public function index()
    {

        $products = Product::with('category')->latest()->paginate(20);
        $categories = Category::all();
        return view('page.faq', [
            'title' => 'FAQ',
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
