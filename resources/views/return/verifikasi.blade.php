@extends('layout.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @foreach ($rentals as $rental)
                            <form action="{{ route('return.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="brand" class="col-sm-4 col-form-label">Merek Mobil:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="brand" value="{{ $rental->car->brand }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_plate" class="col-sm-4 col-form-label">Plat Nomor:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="license_plate" value="{{ $rental->car->license_plate }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input type="hidden" id="rental_id" name="rental_id" value="{{ $rental->id }}"
                                        class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label for="return_date" class="col-sm-4 col-form-label">Tanggal Pengembalian:</label>
                                    <div class="col-sm-8">
                                        <input type="date" id="return_date" name="return_date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start_date" class="col-sm-4 col-form-label">Tanggal Mulai Sewa:</label>
                                    <div class="col-sm-8">
                                        <input type="date" id="start_date" value="{{ $rental->start_date }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="col-sm-4 col-form-label">Tanggal Selesai Sewa:</label>
                                    <div class="col-sm-8">
                                        <input type="date" id="end_date" value="{{ $rental->end_date }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="col-sm-4 col-form-label">Biaya Sewa/Hari:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="rental_rate" value="{{ $rental->car->rental_rate }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="col-sm-4 col-form-label">Lama Sewa:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="rented_days" name="rented_days" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="col-sm-4 col-form-label">Total Bayar:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="total_cost" name="total_cost" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Verifikasi</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function hitungJumlahHari() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            // Ubah format tanggal menjadi objek Date
            var startDateObj = new Date(startDate);
            var endDateObj = new Date(endDate);

            // Hitung selisih hari
            var timeDifference = endDateObj.getTime() - startDateObj.getTime();
            var daysDifference = timeDifference / (1000 * 3600 * 24);

            // Tampilkan hasil di input "rented_days"
            document.getElementById('rented_days').value = daysDifference;

            // Hitung total bayar berdasarkan tarif sewa per hari
            var rentalRate = parseFloat(document.getElementById('rental_rate').value);
            var totalCost = rentalRate * daysDifference;

            // Tampilkan hasil di input "total_cost"
            document.getElementById('total_cost').value = totalCost;
        }

        // Panggil fungsi hitungJumlahHari() saat mengubah nilai input tanggal
        document.getElementById('start_date').addEventListener('change', hitungJumlahHari);
        document.getElementById('end_date').addEventListener('change', hitungJumlahHari);

        // Panggil fungsi hitungJumlahHari() saat halaman dimuat (untuk menghitung secara default jika tanggal sudah diisi sebelumnya)
        hitungJumlahHari();
    </script>
    <script>
        // Fungsi untuk mengisi tanggal saat ini pada input "return_date"
        function isiTanggalSaatIni() {
            var today = new Date();
            var year = today.getFullYear();
            var month = ('0' + (today.getMonth() + 1)).slice(-2); // Tambahkan 0 di depan jika bulan < 10
            var day = ('0' + today.getDate()).slice(-2); // Tambahkan 0 di depan jika tanggal < 10
            var currentDate = year + '-' + month + '-' + day;

            document.getElementById('return_date').value = currentDate;
        }

        // Panggil fungsi isiTanggalSaatIni() saat halaman dimuat
        window.onload = function() {
            isiTanggalSaatIni();
        };
    </script>
@endsection
