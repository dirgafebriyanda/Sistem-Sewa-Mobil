@extends('layout.index')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}"> <i
                        class="fas fa-fw fa-tachometer-alt"></i>
                    Dashboard</a> / Mengembalikan</h6>
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
                            <th>Penyewa</th>
                            <th>Mobil</th>
                            <th>Plat Nomor</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Lama Sewa</th>
                            <th>Biaya</th>
                            @auth
                                @if (auth()->user()->role == 'Admin')
                                    <th>
                                        Action
                                    </th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($returns as $item)
                            <tr>
                                @auth
                                    @if (auth()->user()->id == $item->rentals->user_id || auth()->user()->role == 'Admin')
                                        <td>{{ $item->rentals->user->name }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->license_plate }}</td>
                                        <td>{{ $item->return_date }}</td>
                                        <td>{{ $item->rented_days }} Hari</td>
                                        <td>Rp. {{ $item->total_cost }}</td>
                                    @endif
                                @endauth
                                @auth
                                    @if (auth()->user()->role == 'Admin')
                                        <td>
                                            <div class="row flex-nowrap">
                                                <div class="col-sm-4">
                                                    <a href="" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <form class="d-inline" action="{{ route('return.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="confirm('Are you sure you want to delete this user?')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                @endauth

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($returns->total() > 0)
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item {{ $returns->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $returns->previousPageUrl() }}">Previous</a>
                            </li>
                            @foreach ($returns->getUrlRange(1, $returns->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $returns->currentPage() ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $url }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $returns->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link"
                                    href="{{ $returns->nextPageUrl() }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
@endsection
