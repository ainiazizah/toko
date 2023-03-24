
@extends('app')
@section('isi')
<div class="row">
    <div class="col-md-12">
        <h2>Tambah Keranjang</h2>
        <br>
        <form action="/keranjang" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="nama_kategori">Pilih Produk</label>
                <select class="form-control" name="id_produk" id="">
                    <option value="" selected disabled>Pilih Produk</option>
                    @foreach ($produk as $pd)
                        <option value="{{ $pd->id }}">{{$pd->nama_produk}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_kategori">Jumlah Pesan</label>
                <input type="text" class="form-control" name="jumlah" placeholder="Masukkan Nama Kategori">
            </div>
            <div class="mb-3">
                <label for="nama_kategori">Pilih Pembeli</label>
                <select class="form-control" name="id_pembeli" id="">
                    <option value="" selected disabled>Pilih Pembeli</option>
                    @foreach ($pembeli as $pb)
                        <option value="{{ $pb->id }}">{{$pb->name}}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Simpan" class="btn btn-md btn-success">
        </form>
    </div>
</div>
@endsection