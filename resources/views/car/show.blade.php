@extends('layout.index')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-2">
                <div class="row no-gutters">
                    <div class="col-md-4 p-4">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @if ($cars->image)
                                    @foreach (explode(',', $cars->image) as $key => $image)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                            class="{{ $key == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                @endif
                            </ol>
                            <div class="carousel-inner bg-dark">
                                @if ($cars->image)
                                    @foreach (explode(',', $cars->image) as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset('storage/car/' . $image) }}"
                                                alt="Car Image {{ $key + 1 }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="card-body">
                            <h4 class="card-title font-weight-bold">{{ $cars->brand }}</h4>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Model : {{ $cars->model }}</li>
                                <li class="list-group-item">Plat Nomor : {{ $cars->license_plate }}</li>
                                <li class="list-group-item">Harga/Hari : Rp. {{ $cars->rental_rate }}</li>
                                <li class="list-group-item">Speifikasi : {{ $cars->specification }}</li>
                            </ul>
                            @auth
                                @if (auth()->user()->role == 'Admin')
                                    <a href="" class="btn btn-success w-100"><i class="fas fa-edit"></i> Edit</a>
                                @endif
                            @endauth
                            @auth
                                @if (auth()->user()->role == 'User')
                                    <a href="{{ route('rental.create', ['car_id' => $cars->id]) }}"
                                        class="btn btn-primary w-100 {{ $cars->status == 1 ? 'disabled' : '' }}">Sewa</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
