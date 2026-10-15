<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order; // models order
use App\Models\OrderDetail;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; //facade db untuk query

//controller untuk mengelola pesanan tiket (handle katalog menu <customer> dan rekap pesanan <admin>)
class OrderController extends Controller
{
    //halaman katalog menu pelanggan
    public function index()
    {
        $events = Event::latest()->get(); //ambil data secara urut dari yang terbaru
         // kirim data $foods ke view admin/foods/index.blade.php
        return view('customer.index', compact('events'));
    }

    // simpan pesanan dari form customer
    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
            'items'          => 'required|array',
        ]);

        //mulai transaksi
        DB::beginTransaction();
        try {
            $total = 0; //total harga pesanan
            $details = []; // untuk simpan detail pesanan

            //loop setiap item yang dipesan
            foreach ($request->items as $eventId => $qty) {
                if ($qty > 0) {
                    //cari data event berdasarkan id
                    $event = Event::findOrFail($eventId);
                    //hitung subtotal = harga x jumlah
                    $subtotal = $event->ticket_price * $qty;
                    $total += $subtotal;
                    //simpan detail ke array sementara
                    $details[] = [
                        'event_id' => $event->id,
                        'quantity' => $qty,
                        'subtotal' => $subtotal,
                    ];
                }
            }

            if (empty($details)) {
                //pop up pesan error yaitu pilih minimal 1 tiket
                return back()->with('error', 'Pilih minimal 1 tiket.');
            }

            //simpan ke tabel orders
            $order = Order::create([
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'total_price'    => $total,
                'status'         => 'Pending',
            ]);

            //simpan detail ke tabel order_details
            foreach ($details as $d) {
                $d['order_id'] = $order->id;
                OrderDetail::create($d);
            }
            //commit
            DB::commit();
            //memberikan pesan sukses terhadap pesanan
            return redirect()->route('customer.success', $order->id);
        } catch (\Exception $e) {
            //rollback: ada error, batalkan semua perubahan
            DB::rollBack();
            //memberikan pesan gagal checkout
            return back()->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }

    // halaman struk 
    public function success(Order $order)
    {
        //memuat detail dan event
        $order->load('orderDetails.event');
        return view('customer.success', compact('order'));
    }

    //dashbaord admin - rekap pesanan masuk
    public function adminDashboard()
    {
        // with('orderDetails.food')
        // ambil semua data yang dibutuhkan
        $orders = Order::with('orderDetails.event')->latest()->get();
        //tampilkan view ke dashboard.blade.php
        return view('dashboard', compact('orders'));
    }

    //update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id); //cari order by id kalau tidak ada = 404
        $order->update(['status' => $request->status]); // update kolom status
        return back()->with('success', 'Status berhasil diupdate.'); // balik ke halama sebelumnya dengan pesan sukses
    }
}