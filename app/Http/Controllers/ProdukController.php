<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('produk')->join('users', 'produk.id_penjual','=','users.id')->join('kategori', 'produk.id_kategori','=','kategori.id')->get();
        return view('produk/index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penjual = User::all();
        $kategori = Kategori::all();
        return view('produk/tambah', ['penjual'=> $penjual,'kategori'=> $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_produk' => 'required',
            'foto_produk' => 'required',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required',
            'jumlah_produk' => 'required',
            'id_penjual' => 'required',
            'id_kategori' => 'required'
        ]);
        $foto_produk = $request->file('foto_produk')->store('Produk', 'public');
        $insert = Produk::create([
            'nama_produk' => $request->nama_produk,
            'foto_produk' => $foto_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'id_penjual' => $request->id_penjual,
            'id_kategori' => $request->id_kategori
        ]);
        if ($insert) {
            return redirect('produk');
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
        $data = DB::table('produk')->join('users', 'produk.id_penjual','=','users.id')->join('kategori', 'produk.id_kategori','=','kategori.id')->where(['produk.id'=>$id])->first();
        $penjual = User::all();
        $kategori = Kategori::all();
        return view('produk/edit',['data' => $data,'penjual' => $penjual,'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required',
            'jumlah_produk' => 'required',
            'id_penjual' => 'required',
            'id_kategori' => 'required'
        ]);
        if ($request->foto_produk != null) {        
            $data_image = Produk::where(['id' => $id])->first();
            if (File::exists($data_image->nama_produk)) {
                File::delete($data_image->nama_produk);
            }
            $foto_produk = $request->file('foto_produk')->store('Produk', 'public');
            $update = Produk::where(['id'=> $id])->update([
                'nama_produk' => $request->nama_produk,
                'foto_produk' => $foto_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'harga_produk' => $request->harga_produk,
                'jumlah_produk' => $request->jumlah_produk,
                'id_penjual' => $request->id_penjual,
                'id_kategori' => $request->id_kategori
            ]);
        }else{
            $update = Produk::where(['id'=> $id])->update([
                'nama_produk' => $request->nama_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'harga_produk' => $request->harga_produk,
                'jumlah_produk' => $request->jumlah_produk,
                'id_penjual' => $request->id_penjual,
                'id_kategori' => $request->id_kategori
            ]);
        }
        if ($update) {
            return redirect('produk');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Produk::find($id)->delete();
        return redirect('/produk');
    }
}
