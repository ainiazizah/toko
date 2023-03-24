<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::all();
        return view('kategori/index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori/tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_kategori' => 'required'
        ]);
        $insert = Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);
        if ($insert) {
            return redirect('kategori');
        }else{
            return redirect('create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Kategori::where(['id' => $id])->first();
        return view('kategori/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_kategori' => 'required'
        ]);
        $update = Kategori::where(['id'=> $id])->update([
            'nama_kategori' => $request->nama_kategori
        ]);
        if ($update) {
            return redirect('kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Kategori::find($id)->delete();
        return redirect('/kategori');
    }
}
