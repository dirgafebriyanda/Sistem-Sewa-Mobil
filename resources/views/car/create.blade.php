@extends('layout.index')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid ">

        <!-- Content -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 justify-content-between d-flex">
                        <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}"> <i
                                    class="fas fa-fw fa-tachometer-alt"></i>
                                Dashboard</a> / <a href="{{ route('car.index') }}">
                                Daftar Mobil</a> / Tambah Mobil</h6>
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <img id="preview" class="img-fluid" src="{{ asset('img/not-found.png') }}"
                                        alt="" width="150px">
                                    <div class="mb-3">
                                        <label>Upload Gambar :</label>
                                        <div class="custom-file">
                                            <input id="images" type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                name="images[]" multiple onchange="previewImage(event)">
                                            <label class="custom-file-label" for="image" id="fileLabel">Pilih
                                                file</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>Merek :</label>
                                        <input type="text" class="form-control" value="{{ old('brand') }}"
                                            name="brand">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Model :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ old('model') }}"
                                                name="model">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>Plat :</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('license_plate') is-invalid @enderror"
                                                value="{{ old('license_plate') }}" name="license_plate">
                                            @error('license_plate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>Harga :</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control" value="{{ old('rental_rate') }}"
                                                name="rental_rate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label>Spesifikasi :</label>
                                        <div class="input-group">
                                            <textarea type="text" class="form-control" name="specification">{{ old('specification') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);

            // Menampilkan nama file
            var input = event.target;
            var fileName = input.files[0].name;
            var label = document.getElementById('fileLabel');
            label.innerHTML = fileName;
        }
    </script>
@endsection
