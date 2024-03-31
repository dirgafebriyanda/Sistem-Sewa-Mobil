@extends('layout.index')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid ">

        <!-- Content -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 justify-content-between d-flex">
                        <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}"> <i
                                    class="fas fa-fw fa-tachometer-alt"></i>
                                Dashboard</a> / <a href="{{ route('car.index') }}">
                                Daftar Mobil</a> / Sewa Mobil</h6>
                        </p>
                    </div>
                    <div class="card-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger" id="notif" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('rental.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Nama :</label>
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                    <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Mobil :</label>
                                <select class="form-control @error('car_id') is-invalid @enderror" name="car_id">
                                    <option value="{{ $cars->id }}" selected>{{ $cars->brand }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Mulai :</label>
                                <div class="input-group">
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}" name="start_date">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Selesai :</label>
                                <div class="input-group">
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}" name="end_date">
                                </div>
                            </div>
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- /.container-fluid -->
    @endsection
