@extends('layout.index')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}"> <i
                        class="fas fa-fw fa-tachometer-alt"></i>
                    Dashboard</a> / Menyewa</h6>
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
                            <th>No</th>
                            <th>Penyewa</th>
                            <th>Mobil</th>
                            <th>Plat Nomor</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            @auth
                                @if (auth()->user()->role == 'Admin')
                                    <th>Action</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentals as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->car->brand }}</td>
                                <td>{{ $item->car->license_plate }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->end_date }}</td>
                                @auth
                                    @if (auth()->user()->role == 'Admin')
                                        <td>
                                            <a href="" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                            <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <form class="d-inline" action="{{ route('user.destroy', $item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="confirm('Are you sure you want to delete this user?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
