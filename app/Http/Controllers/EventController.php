<?php
namespace App\Http\Controllers; //memanggil controllers
use App\Models\Event; //memanggil model event
use Illuminate\Http\Request; // request dari form
use Illuminate\Support\Facades\Storage; // untuk manage file dari storage

//untuk mengelola data tiket, hanya bisa diakses oleh admin yang sudah login
class EventController extends Controller {
//tampilkan daftar semua event, dipanggil saat admin buka admin/events
    public function index() {
        $events = Event::latest()->paginate(10); //ambil data dari terbaru, 10 per halaman
        //kirim data events ke view admin/events/index.blade.php
        return view('admin.events.index', compact('events'));
    }

    //tampilkan form untuk menambahkan event 
    public function create() {
    return view('admin.events.create'); } // tapilkan view ke form tambah

    //untuk simpan data event ke database. dipannggil saat  user submit form tambah 
    public function store(Request $request) {
        //validasi input dari form
        $validated = $request->validate([
            'title' => 'required|string|max:255', //wajib teks
            'category' => 'required|in:Musik,Festival,Seminar', //3 kategori pilihan
            'ticket_price' => 'required|integer|min:0', //wajib angka
            'description' => 'required|string', //wajib teks
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',//gambar produk 
        ]);

        //user upload gambar baru
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }
        
        Event::create($validated);
        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event) { return view('admin.events.show', compact('event')); }

    public function edit(Event $event) { return view('admin.events.edit', compact('event')); }

    public function update(Request $request, Event $event) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Musik,Festival,Seminar',
            'ticket_price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $validated['image'] = $request->file('image')->store('events', 'public');
        }
        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event berhasil diupdate.');
    }

    public function destroy(Event $event) {
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}