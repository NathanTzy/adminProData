@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data distributor</h1>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data</h4>
                </div>
                <div class="card-body">
                    <h4>{{ $distributor->nama }}</h4>
                    <p>{{ $distributor->alamat }}</p>
                    <p>{{ $distributor->no_telp }}</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Penjualan</th>
                                <th>Harian</th>
                                <th>Mingguan</th>
                                <th>Bulanan</th>
                                <th>Tahunan</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>10</td>
                                <td>70</td>
                                <td>320</td>
                                <td>1200</td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('distributor.index') }}" class="mr-2 btn btn-primary">Kembali</a>
                    <a href="{{ route('distributor.index') }}" class="mr-2 btn btn-warning">Update</a>

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
