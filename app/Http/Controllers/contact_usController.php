<?php

namespace App\Http\Controllers;

use App\Models\contact_us;
use Illuminate\Http\Request;

class contact_usController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = contact_us::orderBy('created_at', 'DESC')->get(); // Mengambil semua data dari tabel contact_us
        return view('contact_us.index', compact('contacts')); // Menampilkan view dengan data contacts
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = contact_us::findOrFail($id); // Menemukan pesan berdasarkan ID
        return view('contact_us.show', compact('contact')); // Mengirimkan data pesan ke view
    }

    public function edit($id)
    {
        $contact = contact_us::findOrFail($id); // Find the message by ID
        return view('contact_us.edit', compact('contact')); // Pass the contact to the edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|max:150',
            'message' => 'required',
        ]);

        $contact = contact_us::findOrFail($id); // Find the message by ID
        $contact->update($request->all()); // Update the contact with the new data

        return redirect()->route('contact_us.index')->with(['berhasil' => 'Pesan Berhasil Diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = contact_us::findOrFail($id); // Menemukan pesan berdasarkan ID
        $contact->delete(); // Menghapus pesan
        return redirect()->route('contact_us.index')->with(['berhasil' => 'Pesan Berhasil Dihapus']);
    }
}
