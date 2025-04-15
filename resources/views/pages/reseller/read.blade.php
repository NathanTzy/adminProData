@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data reseller</h1>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data reseller</h4>
                </div>
                <div class="card-body">
                    <h4>{{ $re->nama }}</h4>
                    <p>{{ $re->alamat }}</p>
                    <p>{{ $re->no_telp }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('reseller.index') }}" class="mr-2 btn btn-primary">Kembali</a>
                    <a href="{{ route('reseller.edit', $re->id) }}" class="mr-2 btn btn-warning">Update</a>

                </div>
            </div>
            <div class="section-body">



            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
