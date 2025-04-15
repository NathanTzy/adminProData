@extends('layouts.app')

@section('title', 'Create Distributor')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Reseller</h1>
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

                                <form action="{{ route('reseller.store') }}" method="POST">
                                    @csrf
                                    <div class="mt-0 section-title">Nama lengkap</div>
                                    <div class="form-group">
                                        <label>Masukkan nama lengkap</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ old('nama') }}" required>
                                    </div>
                                    <div class="mt-0 section-title">No telp</div>
                                    <div class="form-group">
                                        <label>Masukkan no telp</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control phone-number" name="no_telp"
                                                value="{{ old('no_telp') }}" required pattern="^[0-9]{13,15}$"
                                                title="No telp harus terdiri dari 13-15 angka">
                                        </div>
                                    </div>
                                    <div class="mt-0 section-title">Alamat</div>
                                    <div class="form-group">
                                        <label>Masukkan alamat lengkap</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{ old('alamat') }}" required>
                                    </div>

                                    <a href="{{ route('reseller.create') }}" class="mr-2 btn btn-danger">Kembali</a>

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
