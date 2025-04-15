@extends('layouts.app')

@section('title', 'Create Distributor')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Update {{ $barang->nama }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Menampilkan error jika ada -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mt-0 section-title">Nama barang</div>
                                    <div class="form-group">
                                        <label>Ubah nama barang</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('nama', $barang->name) }}" required>
                                    </div>
                                    
                                    <div class="mt-0 section-title">Harga</div>
                                    <div class="form-group">
                                        <label>Ubah harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control phone-number" name="price"
                                                value="{{ old('harga', $barang->price) }}" required title="Harga tidak valid">
                                        </div>
                                    </div>
                                
                                    <div class="mt-0 section-title">Stok</div>
                                    <div class="form-group">
                                        <label>Ubah stok</label>
                                        <input type="text" class="form-control" name="quantity"
                                            value="{{ old('stok', $barang->quantity) }}" required>
                                    </div>
                                
                                    <a href="{{ route('barang.index') }}" class="mr-2 btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- jQuery (Pastikan jQuery di-load sebelum kode JS lain) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@endpush
