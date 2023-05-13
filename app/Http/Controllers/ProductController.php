<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Load products and categories with eager loading
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::all();

        // Product Page
        return view('admin.pages.product', [
            'title' => 'Product',
            'products' => $products,
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
        // new Product page
        // Load products and categories with eager loading
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::all();

        // Product Page
        return view('admin.pages.new.newprod', [
            'title' => 'Product',
            'products' => $products,
            'categories' => $categories
        ]);
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
        $rules =  [
            'name' => 'required|string|max:50',
            'description' => 'required|max:255',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama produk wajib diisi',
            'name.max' => 'Nama tidak boleh melebih dari 50 karakter',
            'description.required' => 'Deskripsi produk wajib diisi',
            'stock.required' => 'Stock harus diisi',
            'image.required' => 'Gambar produk wajib diisi',
            'image.image' => 'File yang diunggah harus berupa gambar',
            'image.mimes' => 'Format file yang diperbolehkan adalah jpeg, png, jpg, gif, atau svg',
            'image.max' => 'Ukuran file tidak boleh melebihi 2MB',
            'price.required' => 'Harga produk wajib diisi.',
            'category_id.required' => 'Kategori wajib diisi',
        ];

        // Upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/products');
        }

        // Validation Variable Complete
        $validatedData = $request->validate($rules, $messages);

        // slug / Short Name
        $short = Str::slug($validatedData['name']);

        $product = new Product();
        $product->category_id = $validatedData['category_id'];
        $product->short_name = $short;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->product_type = $request['product_type'];
        $product->image_path = '/uploads/products/' . $imageName;
        // dd($product);
        $product->save();

        $image->move($destinationPath, $imageName);
        // redirect ke halaman sukses
        return redirect('/dashboard/product')->with('success', 'Berhasil menambahkan produk baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($short_name)
    {
        // dd($short_name);
        // Edit Form
        // Load products and categories with eager loading
        $products = Product::where('short_name', $short_name)->with('category')->first();
        $categories = Category::all();

        // Product Page
        return view('admin.pages.edit.editprod', [
            'title' => 'Product',
            'product' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Validation
        $rules =  [
            'name' => 'required|string|max:50',
            'description' => 'required|max:255',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,bmp,png',
            'category_id' => 'required',
        ];

        // Upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/products');
        } else {
            $image = null;
            $imageName = null;
        }

        // Validation Variable Complete
        $validatedData = $request->validate($rules);
        // slug / Short Name
        $short = Str::slug($validatedData['name']);


        $productArray = [
            'category_id' => $validatedData['category_id'],
            'short_name' => $short,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'product_type' => $request['product_type'],
            'image_path' => $imageName == null ? $product->image_path : '/uploads/products/' . $imageName,
        ];

        Product::where('id', $product->id)->update($productArray);

        // Move the image
        $image != null ? $image->move($destinationPath, $imageName) : null;

        // redirect ke halaman sukses
        return redirect('/dashboard/product')->with('success', 'Product updated successfully!');
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
        $product = Product::where('short_name', $id)->first();
        $product->delete();
        return redirect('/dashboard/product')->with('success', 'Product deleted successfully!');
    }
}
