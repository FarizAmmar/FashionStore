<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Order Variable
        $order = Order::with(['product', 'product.category'])->latest()->paginate(10);
        // Index Order
        return view('admin.pages.order', [
            'title' => 'Order',
            'orders' => $order
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(string $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $orders = Order::with(['user'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('page.myorders', [
            'title' => 'My Orders',
            'user' => $user,
            'orders' => $orders,
            'categories' => Category::all(),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        //Bot setup
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage';

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $name = explode(" ", $request->input('name'));
        $address = explode(" ", $request->input('address'));

        $order = Order::where('id', $id)->first();
        $order->fname = $name[0];
        $order->lname = $name[1];
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->address = $address[0];
        $order->city = $address[1];
        $order->postcode = $address[2];

        // Data message telegram
        $data = [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => 'Pengguna dengan username : ' . auth()->user()->username . ', telah mengubah pesanananya.',
        ];

        $order->save();

        // Bot Response
        $response = $client->post($url, [
            'body' => json_encode($data)
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->back()->with('success', 'Pesanan anda berhasil di update.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $order = Order::where('id', $id)->first();

        //Bot setup
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage';

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $data = [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => 'Pengguna dengan username : ' . auth()->user()->username . ', telah membatalkan pesananan ' . $order->product->name,
        ];

        // Bot Response
        $response = $client->post($url, [
            'body' => json_encode($data)
        ]);

        $order->delete();

        return redirect()->back()->with('delete', 'Pesanan anda berhasil di batalkan.');
    }
}
