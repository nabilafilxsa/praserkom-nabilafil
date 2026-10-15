<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Tiket Konser</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
<div class="max-w-5xl mx-auto">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🎫 Katalog Konser & Event</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih event dan pesan tiket Anda</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">{{ session('error') }}</div>
    @endif

    <form id="orderForm" action="{{ route('customer.checkout') }}" method="POST">
        @csrf

        {{-- Info Pemesan --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border mb-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">1. Informasi Pemesan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                    <input type="text" name="customer_name" required placeholder="Masukkan nama pemesan"
                           class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="customer_email" required placeholder="Masukkan email"
                           class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
        </div>

        {{-- Pilih Event --}}
        <h2 class="text-lg font-bold text-gray-700 mb-4">2. Pilih Tiket</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($events as $event)
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col">
                @if($event->image)
                    <img src="{{ asset('storage/'.$event->image) }}" class="w-full h-40 object-cover">
                @else
                    <div class="bg-gray-200 h-40 flex items-center justify-center text-gray-400">🎵 Tanpa Gambar</div>
                @endif
                <div class="p-4 flex-1">
                    <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2.5 py-0.5 rounded">{{ $event->category }}</span>
                    <h3 class="font-bold text-gray-800 text-lg mt-2">{{ $event->title }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ Str::limit($event->description, 80) }}</p>
                    <p class="font-bold text-green-600 mt-3">Rp {{ number_format($event->ticket_price) }}</p>
                </div>
                <div class="p-4 bg-gray-50 border-t">
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Jumlah Tiket</label>
                    <input type="number" name="items[{{ $event->id }}]" min="0" value="0"
                           class="w-full border rounded-lg px-3 py-1.5 text-center">
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl shadow-md">
                🎟️ Pesan Sekarang
            </button>
        </div>
    </form>
</div>
</body>
</html>