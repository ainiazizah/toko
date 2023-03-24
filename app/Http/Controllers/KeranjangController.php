<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Keranjang;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('keranjang')->leftjoin('produk', 'keranjang.id_produk','=','produk.id')->select(['keranjang.*','produk.nama_produk' ])->get();
        return view('keranjang/index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembeli = User::all();
        $produk = Produk::all();
        return view('keranjang/tambah', ['pembeli' => $pembeli,'produk' => $produk]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required',
            'id_pembeli' => 'required',
        ]);
        $data_produk = Produk::where(['id' => $request->id_produk])->first();
        $insert = Keranjang::create([
            'jumlah' => $request->jumlah,
            'harga' => $data_produk->harga_produk * $request->jumlah,
            'id_pembeli' => $request->id_pembeli,
            'id_produk' => $request->id_produk,
        ]);
        if ($insert) {
            return redirect('keranjang');
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
        
        $data = DB::table('keranjang')->join('users', 'keranjang.id_pembeli','=','users.id')->join('produk', 'keranjang.id_produk','=','produk.id')->select(['keranjang.*','produk.nama_produk',])->first();
        $pembeli = User::all();
        $produk = Produk::all();
        return view('keranjang/edit',['data' => $data,'pembeli' => $pembeli,'produk' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required',
            'id_pembeli' => 'required',
        ]);
        $data_produk = Produk::where(['id' => $request->id_produk])->first();
        $update = Keranjang::where(['id'=> $id])->update([
            'jumlah' => $request->jumlah,
            'harga' => $data_produk->harga_produk * $request->jumlah,
            'id_pembeli' => $request->id_pembeli,
            'id_produk' => $request->id_produk,
        ]);
            return redirect('keranjang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Keranjang::find($id)->delete();
        return redirect('/keranjang');
    }
}
