<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Sukses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-sm">
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
        ✅ Pesanan berhasil! Order ID: <b>#{{ $order->id }}</b>
    </div>
    <p><b>Nama:</b> {{ $order->customer_name }}</p>
    <p><b>Email:</b> {{ $order->customer_email }}</p>
    <p class="mt-2"><b>Status:</b> <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold">{{ $order->status }}</span></p>

    <h3 class="font-bold mt-6 mb-2">Rincian Tiket</h3>
    <table class="w-full text-sm">
        <thead><tr class="border-b"><th class="text-left py-2">Event</th><th class="text-left py-2">Qty</th><th class="text-right py-2">Subtotal</th></tr></thead>
        <tbody>
            @foreach($order->orderDetails as $d)
            <tr class="border-b"><td class="py-2">{{ $d->event->title }}</td><td class="py-2">{{ $d->quantity }}</td><td class="py-2 text-right">Rp {{ number_format($d->subtotal) }}</td></tr>
            @endforeach
        </tbody>
        <tfoot><tr class="bg-gray-50"><th colspan="2" class="text-right py-2">Total</th><th class="text-right py-2 text-green-600">Rp {{ number_format($order->total_price) }}</th></tr></tfoot>
    </table>
    <a href="{{ route('customer.index') }}" class="inline-block mt-6 bg-gray-800 text-white px-5 py-2 rounded">← Kembali</a>
</div>
</body>
</html>