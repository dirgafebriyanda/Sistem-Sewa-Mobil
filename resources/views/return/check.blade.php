@extends('layout.index')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 justify-content-between d-flex">
                        <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}"> <i
                                    class="fas fa-fw fa-tachometer-alt"></i>
                                Dashboard</a> / <a href="{{ route('car.index') }}">
                                Daftar Mobil</a> / Kembalikan Mobil</h6>
                        </p>
                    </div>
                    <div class="card-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger" id="notif" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('return.verifikasi') }}" method="get">
                            @csrf
                            <div class="mb-3">
                                <label>Plat Nomor :</label>
                                <input type="text" class="form-control" name="license_plate"
                                    value="{{ old('license_plate') }}" placeholder="Masukan Plat nomor mobil">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Cek</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
