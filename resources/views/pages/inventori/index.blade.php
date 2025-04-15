@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Inventori</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Nama barang</th>
                                                <th>Harga satuan</th>
                                                <th>stok tersisa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($barang as $e)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $e->name }}</td>
                                                    <td class="text-center">{{ 'Rp ' . number_format($e->price, 2, ',', '.') }}</td>
                                                    <td class="text-center">{{ $e->quantity }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <form action="{{ route('barang.destroy', $e->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Yakin ingin menghapus?');"
                                                                class="mr-2">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger font-weight-bold">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('barang.show', $e->id) }}"
                                                                class="mr-2 btn btn-info font-weight-bold">
                                                                <i class="fa fa-eye"></i> View
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Belum ada barang tersimpan
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <a href="{{ route('barang.create') }}" class="flex btn btn-warning font-weight-bold "><i
                                            class="fa fa-plus"></i> Tambahkan
                                        barang</a>
                                </div>

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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
