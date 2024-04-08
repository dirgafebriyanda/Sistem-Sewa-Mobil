@extends('layout.index')
@section('content')
    <div class="row justify-content-end">
        <div class="col-md-4">
            <form action="{{ route('car.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="search" value="{{ request('search') }}" id="search" name="search" class="form-control"
                        placeholder="Cari...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between d-flex">
            <h6 class="m-0 font-weight-bold text-dark"><a href=""> <i class="fas fa-fw fa-tachometer-alt"></i>
                    Dashboard</a> / Mobil</h6>
            @auth
                @if (auth()->user()->role == 'Admin')
                    <a href="{{ route('car.create') }}" class="btn btn-primary" title="Tambah"><i class="fas fa-plus"></i></a>
                @endif
                @if (auth()->user()->role == 'User')
                    <a href="{{ route('return.check') }}" class="btn btn-primary" title="Kembalikan">Kembalikan Mobil</a>
                @endif
            @endauth
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" id="notif" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mobil</th>
                            <th>Model</th>
                            <th>Plat</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $item)
                            <tr>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->license_plate }}</td>
                                <td>Rp. {{ $item->rental_rate }}</td>
                                <td>
                                    @if ($item->status)
                                        Disewa
                                    @else
                                        Tersedia
                                    @endif
                                </td>
                                <td>
                                    @auth
                                        @if (auth()->user()->role == 'Admin')
                                            <div class="row flex-nowrap">
                                                <div class="col-sm-3">
                                                    <a href="{{ route('car.show', $item->id) }}" class="btn btn-dark"><i
                                                            class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @auth
                                                        @if ($item->status != 1)
                                                            <form class="d-inline" action="{{ route('car.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger {{ $rentals->contains('car_id', $item->id) ? 'disabled' : '' }}"
                                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data mobil {{ $item->brand }} ?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>

                                                            </form>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>
                                        @endif
                                    @endauth
                                    @auth
                                        @if (auth()->user()->role == 'User')
                                            <a href="{{ route('rental.create', ['car_id' => $item->id]) }}"
                                                class="btn btn-primary {{ $item->status == 1 ? 'disabled' : '' }}">Sewa</a>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($cars->total() > 0)
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item {{ $cars->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $cars->previousPageUrl() }}">Previous</a>
                            </li>
                            @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $cars->currentPage() ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $url }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $cars->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link"
                                    href="{{ $cars->nextPageUrl() }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
@endsection
