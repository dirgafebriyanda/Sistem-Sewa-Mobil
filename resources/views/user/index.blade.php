@extends('layout.index')
@section('content')
    <div class="row justify-content-end">
        <div class="col-md-4">
            <form action="{{ route('user.index') }}" method="GET">
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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}"> <i
                        class="fas fa-fw fa-tachometer-alt"></i>
                    Dashboard</a> / Pengguna</h6>
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
                            <th>Nama</th>
                            <th>No SIM</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->driver_license_number }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="row flex-nowrap">
                                        <div class="col-sm-3">
                                            <a href="{{ route('show', $item->id) }}" class="btn btn-success"><i
                                                    class="fas fa-eye"></i></a>
                                        </div>
                                        <div class="col-sm-3">
                                            @auth
                                                @if ($item->role != 'Admin')
                                                    <form class="d-inline" action="{{ route('user.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus akun {{ $item->name }} ?' )"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($users->total() > 0)
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a>
                            </li>
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $url }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link"
                                    href="{{ $users->nextPageUrl() }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
@endsection
