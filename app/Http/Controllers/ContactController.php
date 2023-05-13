<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // Page.Contact
        return view('page.contact', [
            'title' => 'Contact Us',
            'categories' => $categories,
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
            'name' => 'required|string|max:50',
            'email' => 'required|email:rfc,dns|max:100',
            'address' => 'string|max:255',
            'message' => 'required|string|min:50|max:255'
        ];

        //Bot setup
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage';

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        // Validating
        $request->validate($rules);

        // Data message telegram
        $data = [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => 'Nama : ' . $request->input('name') . "\n" .
                'Email : ' . $request->input('email') . "\n" .
                'Alamat : ' . $request->input('address') . "\n" .
                'Pesan : ' . $request->input('message') . "\n"
        ];

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
        return redirect('/contact')->with('success', 'Pesan anda sudah kami terima, mohon tunggu jawaban dari kami lewat E-Mail anda.');
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
