<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('filter') == 'termurah') {
            $products = Product::with('category')
                ->search(request(['search', 'category']))
                ->orderBy('price', 'desc')
                ->paginate(100);
        } else if (request('filter') == 'termahal') {
            $products = Product::with('category')
                ->search(request(['search', 'category']))
                ->orderBy('price', 'asc')
                ->paginate(100);
        } else {
            $products = Product::with('category')
                ->latest()
                ->search(request(['search', 'category']))
                ->paginate(100);
        }

        // Display the home page
        return view('page.home', [
            'title' => 'Home',
            'products' => $products,
            'categories' => Category::all(),
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
        //Bot setup
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage';

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        // Validation Variable
        $rules = [
            'fname' => 'required|string|max:20',
            'lname' => 'required|string|max:20',
            'phone' => 'required|max:14',
            'stock' => 'required',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'postcode' => 'required|string|max:5',
            'size' => 'required',
        ];

        $messages = [
            'fname.required' => 'Nama depan harus diisi.',
            'lname.required' => 'Nama belakang harus diisi.',
            'phone.required' => 'Nomer telpon harus diisi.',
            'stock.required' => 'Stock harus diisi minimal 1.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'address.required' => 'Alamat harus diisi.',
            'city.required' => 'Kota harus diisi.',
            'postcode.required' => 'Kode post harus diisi.',
            'size.required' => 'Minimal memilih pilih salah satu size.',
        ];

        // Validation Variable Complete
        $validatedData = $request->validate($rules, $messages);

        $order = new Order(); //
        $order->fname = $validatedData['fname'];
        $order->lname = $validatedData['lname'];
        $order->phone = $validatedData['phone'];
        $order->email = $validatedData['email'];
        $order->address = $validatedData['address'];
        $order->city = $validatedData['city'];
        $order->postcode = $validatedData['postcode'];
        $order->qty = $validatedData['stock'];
        $order->size = $validatedData['size'];
        $order->product_id = $request->product_id;


        $product = Product::where('id', $request->product_id)->first();
        // $product = $product->short_name;

        // Data message telegram
        $data = [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => 'Nama : ' . $request->input('fname') . ' ' . $request->input('lname') . "\n" .
                'Email : ' . $request->input('email') . "\n" .
                'Nomer Hp : ' . $request->input('phone') . "\n" .
                'Alamat : ' . $request->input('address') . ', ' . $request->input('city') . ', ' . $request->input('postcode') . "\n" .
                'Nama Produk : ' . $product->name . "\n" .
                'Ukuran : ' . strtoupper($request['size']) . "\n" .
                'Jenis Ukuran : ' . ucfirst(strtolower($product->product_type)) . "\n" .
                'Jenis Bahan : ' . $product->category->name . "\n" .
                'Jumlah :' . ' ' . $request->input('stock') . "\n\n" .
                'Note : Pesanan akan selesai dalam waktu 2-5 hari setelah pre order dan admin akan memberitahu via telegram jika pesanan sudah selesai. Pastikan nomor handphone terhubung dengan telegram.',
        ];

        // dd($data);
        // Save To Table Order
        $order->save();

        // Bot Response
        $response = $client->post($url, [
            'body' => json_encode($data)
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->back()->with('success', 'Pesanan berhasil di buat.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan');
        }

        // redirect ke halaman sukses
        return redirect('/details/' . $product->short_name)->with('success', 'Pesanan anda berhasil kami terima.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show($short_name)
    {
        // Load products and categories with eager loading
        $products = Product::where('short_name', $short_name)->with('category')->first();
        $categories = Category::all();

        // Display Details Product
        return view('page.details', [
            'title' => 'Details Product',
            'product' => $products,
            'categories' => $categories
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
