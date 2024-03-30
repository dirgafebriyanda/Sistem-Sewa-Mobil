@extends('layout.index')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 justify-content-between d-flex">
            <h6 class="m-0 font-weight-bold text-dark"><a href=""> <i class="fas fa-fw fa-tachometer-alt"></i>
                    Dashboard</a> / Mobil</h6>
            @auth
                @if (auth()->user()->role == 'Admin')
                    <a href="{{ route('car.create') }}" class="btn btn-primary" title="Tambah"><i class="fas fa-plus"></i></a>
                @endif
                @if (auth()->user()->role == 'User')
                    <a href="{{ route('return.check') }}" class="btn btn-primary" title="Kembalikan">Kembalikan</a>
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
                            <th>No</th>
                            <th>Merek</th>
                            <th>Model</th>
                            <th>Plat</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->license_plate }}</td>
                                <td>{{ $item->rental_rate }}</td>
                                <td>
                                    @auth
                                        @if (auth()->user()->role == 'Admin')
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
                                        @endif
                                    @endauth
                                    @auth
                                        @if (auth()->user()->role == 'User')
                                            @php
                                                $isRented = $rentals->contains('car_id', $item->id);
                                            @endphp

                                            <a href="{{ $isRented ? '#' : route('rental.create', ['car_id' => $item->id]) }}"
                                                class="btn btn-primary{{ $isRented ? ' disabled' : '' }}">
                                                Sewa
                                            </a>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
