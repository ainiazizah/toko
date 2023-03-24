
@extends('app')
@section('isi')
<div class="row">
    <div class="col-md-12">
        <h2>Keranjang</h2>
        <br>
        <a href="keranjang/create" class="btn btn-md btn-success">Tambahkan ke Keranjang</a>
        
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah Pesan</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                      <th scope="row">1</th>
                        <td>
                            {{$dt->nama_produk}}
                        </td>
                        <td>
                            {{$dt->jumlah}}
                        </td>
                        <td>
                            {{$dt->harga}}
                        </td>
                      <td>
                        <form action="/keranjang/{{$dt->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="/keranjang/{{$dt->id}}/edit" class="btn btn-md btn-warning mr-2">Edit</a>
                            <input class="btn btn-md btn-danger" type="submit" value="Hapus">
                        </form>
                      </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection