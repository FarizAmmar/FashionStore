<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        // Product Page
        return view('admin.pages.category', [
            'title' => 'Category',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $rules = [
            'name' => 'required|string|max:30',
        ];

        $msg = [
            'name' => 'Nama kategori harus di isi',
        ];

        $validate = $request->validate($rules, $msg);

        // slug / Short Name
        $short = Str::slug($validate['name']);

        // Category Initialization
        $category = new Category();
        $category->name = $validate['name'];
        $category->short_name = $short;
        $category->save();

        // redirect ke halaman sukses
        return redirect('/dashboard/category')->with('success', 'Berhasil menambahkan kategori baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($short_name)
    {

        if (request('filter') == 'termurah') {
            $products = Product::with('category')
                ->latest()
                ->search(request(['search', 'category']))
                ->orderBy('price', 'asc')
                ->paginate(100);
        } else if (request('filter') == 'termahal') {
            $products = Product::with('category')
                ->latest()
                ->search(request(['search', 'category']))
                ->orderBy('price', 'desc')
                ->paginate(100);
        } else if (request('filter') == 'popular') {
            $products = Product::with('category')
                ->select('products.*', DB::raw('COUNT(orders.product_id) as order_count'))
                ->leftJoin('orders', 'products.id', '=', 'orders.product_id')
                ->groupBy('products.id')
                ->orderBy('order_count', 'desc')
                ->search(request(['search', 'category']))
                ->paginate(100);
        } else {
            $products = Product::with('category')
                ->latest()
                ->search(request(['search', 'category']))
                ->paginate(100);
        }

        // Take all category Replace variable above
        $category = Category::all();

        return view('page.category', [
            'title' => 'Categories',
            'products' => $products,
            'categories' => $category,
            'short' => $short_name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validation
        $rules =  [
            'name' => 'required|string|max:30',
        ];

        // Validation Variable Complete
        $validatedData = $request->validate($rules);

        // slug / Short Name
        $short = Str::slug($validatedData['name']);

        // Array Category
        $categoryArray = [
            'name' => $validatedData['name'],
            'short_name' => $short,
        ];

        Category::where('id', $category->id)->update($categoryArray);

        // redirect ke halaman sukses
        return redirect('/dashboard/category')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find Product by shortname
        $category = Category::where('short_name', $id)->first();
        $category->delete();
        return redirect('/dashboard/category')->with('success', 'Category deleted successfully!');
    }
}
