@extends('layout.index')
@section('content')
    @auth
        @if (auth()->user()->role == 'Admin')
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Pendapatan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalMonthlyEarnings }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pendapatan Rata-rata</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $averageEarnings }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasks Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Mobil
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countCars }}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-car fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Mobil Disewa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countRentals }}/{{ $countReturns }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-car-side fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <div class="row flex-nowrap justify-content-between">
        <div class="col-sm-4">
            @if (auth()->user()->role == 'User')
                <a href="{{ route('return.check') }}" class="btn btn-primary" title="Kembalikan">Kembalikan Mobil</a>
            @endif
        </div>
        <div class="col-sm-4">
            <form action="{{ route('dashboard.index') }}" method="GET">
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

    <div class="row d-flex justify-content-center">
        @if ($cars->count() > 0)
            @foreach ($cars as $item)
                <div class="col-lg-4 p-2">
                    <div class="card p-2 shadow-lg">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner bg-dark">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ asset('img/car/black1.webp') }}"
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('img/car/revisi.webp') }}"
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('img/car/blue-black.webp') }}"
                                                alt="First slide">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $item->brand }}</h5>
                            <span class="card-text">{{ $item->model }}</span>
                            <p class="card-text">Rp. {{ $item->rental_rate }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                        </ul>
                        <div class="btn-group mt-2">

                            @auth
                                @if (auth()->user()->role == 'User' || auth()->user()->role == 'Admin')
                                    <a href="{{ route('car.show', $item->id) }}" class="btn btn-success w-100">Detail</a>
                                @endif
                            @endauth
                            @auth
                                @if (auth()->user()->role == 'User')
                                    <a href="{{ route('rental.create', ['car_id' => $item->id]) }}"
                                        class="btn btn-primary w-100 {{ $item->status == 1 ? 'disabled' : '' }}">Sewa</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-4">
                <div class="card text-center shadow-lg">
                    <div class="card-body">
                        <img src="{{ asset('img/not-found.png') }}" class="card-img-top" alt="Image">
                        <h5 class="card-title font-weight-bold text-danger">Mobil Belum Tersedia</h5>
                    </div>
                </div>
            </div>
        @endif
    </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil nilai total pendapatan dari elemen dengan id "totalEarnings"
            var totalEarningsElement = document.getElementById("totalEarnings");
            var totalEarningsValue = parseFloat(totalEarningsElement.textContent.replace(/[^\d.-]/g,
                '')); // Hilangkan karakter non-numeric dan konversi ke angka float

            // Hitung total pendapatan bulanan
            var monthlyEarnings = totalEarningsValue *
                12; // Dianggap bahwa nilai total_cost adalah pendapatan bulanan, sehingga dikalikan dengan 12 untuk mendapatkan pendapatan tahunan

            // Tampilkan total pendapatan bulanan pada halaman
            totalEarningsElement.textContent = monthlyEarnings.toFixed(
                2); // Tampilkan hasil dengan dua angka desimal
        });
    </script>

@endsection
