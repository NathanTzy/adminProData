@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Distributors Account Control</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <form class="pt-3 pl-3" action="{{ route('user.index') }}" method="GET">
                                <div class="input-group col-3">
                                    <input type="text" class="form-control" placeholder="Search" name="name"
                                        value="{{ request('name') }}">
                                    <div class="pl-3 input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $e)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $e->name }}</td>
                                                    <td class="text-center">{{ $e->role }}</td>
                                                    <td class="text-center">{{ $e->email }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <form action="{{ route('user.destroy', $e->id) }}"
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
                                                            <a href="{{ route('user.edit', $e->id) }}"
                                                                class="mr-2 btn btn-warning font-weight-bold">
                                                                <i class="fa fa-pen"></i> Update
                                                            </a>
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Belum ada user terdaftar</td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                    <a href="{{ route('user.create') }}" class="flex btn btn-warning font-weight-bold ">
                                        <i class="fa fa-plus"></i> Create user
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
            @if ($users->total() > $users->perPage())
                <nav class="d-inline-block">
                    {{ $users->appends(request()->query())->links() }}
                </nav>
            @endif
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
