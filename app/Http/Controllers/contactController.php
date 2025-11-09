<?php

namespace App\Http\Controllers;

use App\Models\contact_us;
use Illuminate\Http\Request;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = contact_us::orderBy('created_at', 'DESC')->get(); // Mengambil semua data dari tabel contact_us
        return view('public.contact', compact('contacts')); // Menampilkan view dengan data contacts
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = contact_us::findOrFail($id); // Menemukan pesan berdasarkan ID
        return view('contact.show', compact('contact')); // Mengirimkan data pesan ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create'); // Menampilkan form untuk mengirim pesan baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|max:150',
            'message' => 'required',
        ]);

        // Menyimpan data ke dalam tabel contact_us
        contact_us::create($request->only(['first_name', 'last_name', 'email', 'subject', 'message']));

        return redirect()->route('public.contact')->with(['berhasil' => 'Pesan Anda Berhasil Dikirim!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = contact_us::findOrFail($id); // Menemukan pesan berdasarkan ID
        $contact->delete(); // Menghapus pesan
        return redirect()->route('public.contact')->with(['berhasil' => 'Pesan Berhasil Dihapus']);
    }
}
