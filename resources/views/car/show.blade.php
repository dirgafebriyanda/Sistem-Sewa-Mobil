@extends('layout.index')
@section('content')
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner bg-dark">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img class="d-block w-100" src="{{ asset('img/car/black1.webp') }}" alt="First slide">
                                </div>
                                <div class="col-sm-6">
                                    <img class="d-block w-100" src="{{ asset('img/car/white1.webp') }}" alt="Second slide">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img class="d-block w-100" src="{{ asset('img/car/revisi.webp') }}" alt="First slide">
                                </div>
                                <div class="col-sm-6">
                                    <img class="d-block w-100" src="{{ asset('img/car/kinetic.webp') }}" alt="Second slide">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img class="d-block w-100" src="{{ asset('img/car/blue-black.webp') }}"
                                        alt="First slide">
                                </div>
                                <div class="col-sm-6">
                                    <img class="d-block w-100" src="{{ asset('img/car/ivory-black.webp') }}"
                                        alt="Second slide">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $cars->brand }}</h5>
            <p class="card-text">{{ $cars->model }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Plat Nomor :{{ $cars->license_plate }}</li>
            <li class="list-group-item">Harga/Hari : Rp. {{ $cars->rental_rate }}</li>
            <li class="list-group-item">Speifikasi : -</li>
        </ul>
        @auth
            @if (auth()->user()->role == 'Admin')
                <a href="" class="btn btn-secondary"><i class="fas fa-edit"></i> Edit</a>
            @endif
        @endauth
        @auth
            @if (auth()->user()->role == 'User')
                <a href="{{ route('rental.create', ['car_id' => $cars->id]) }}"
                    class="btn btn-primary w-100 {{ $cars->status == 1 ? 'disabled' : '' }}">Sewa</a>
            @endif
        @endauth
    </div>
@endsection
