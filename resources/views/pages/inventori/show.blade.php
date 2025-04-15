@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data barang</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2>{{ $barang->name }}</h2>
                    <p>Stok tersisa : {{ $barang->quantity }}</p>
                    <h4 class="mt-4">Riwayat Perubahan</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Stok Sebelumnya</th>
                                <th>Stok Sesudah</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang->histories as $history)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $history->old_value }}</td>
                                    <td>{{ $history->new_value }}</td>
                                    <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $history->id }}">Hapus</button>
                                    </td>
                                </tr>

                                <!-- Modal konfirmasi hapus riwayat -->
                                <div class="modal fade" id="deleteModal{{ $history->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin ingin menghapus riwayat perubahan stok ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <form action="{{ route('barang.history.destroy', $history->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('barang.index') }}" class="mr-2 btn btn-primary">Kembali</a>
                    <a href="{{ route('barang.edit', $barang->id) }}" class="mr-2 btn btn-warning">Update</a>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
