@extends('layout.index')

@section('content')
    <style>
        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                @auth
                    @if (auth()->user()->role == 'Admin')
                        <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}" id="open"
                                readonly> <i class="fas fa-fw fa-tachometer-alt"></i>
                                Dashboard</a> / <a href="{{ route('user.index') }}"> Pengguna </a>/ Profil
                        </h6>
                    @else
                        <h6 class="m-0 font-weight-bold text-dark"><a href="{{ route('dashboard.index') }}" id="open"
                                readonly> <i class="fas fa-fw fa-tachometer-alt"></i>
                                Dashboard</a> / Profil
                        </h6>
                    @endif
                @endauth
            </div>
            @auth
                @if (auth()->user()->id == $users->id)
                    <div class="dropdown mb-4">
                        <a href="#" class="tex-decoration-none text-dark" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#gantipassword">
                                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ganti Password
                            </a>
                        </div>
                    </div>
                @endif
            @endauth

        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" id="notif" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" id="notif" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('update', $users->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3 border-right">
                        @auth
                            @if (auth()->user()->id == $users->id)
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" value="" id="editcheck">
                                    <label class="form-check-label text-dark" for="editcheck">
                                        Edit Profile
                                    </label>
                                </div>
                            @endif
                        @endauth

                        <div class="d-flex mt-4 flex-column align-items-center text-center">
                            @if ($users->image)
                                <img id="preview" class="rounded-circle" width="150px"
                                    src="{{ asset('storage/' . $users->image) }}">
                            @else
                                <img id="preview" class="rounded-circle" width="150px"
                                    src="{{ $users->gender == 'Laki-laki' ? asset('img/user/man.png') : ($users->gender == 'Perempuan' ? asset('img/user/woman.png') : asset('img/user/user-default.png')) }}">
                            @endif
                            <span class="font-weight-bold">{{ $users->name }}</span>
                            <span class="text-black-50">{{ $users->email }}</span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Foto Profil :</label>
                                    <input type="hidden" name="oldImage" value="{{ $users->image }}">
                                    <div class="custom-file">
                                        <input id="image" type="file"
                                            class="custom-file-input @error('image') is-invalid @enderror" name="image"
                                            onchange="previewImage(event)" disabled>
                                        <label class="custom-file-label" for="image" id="fileLabel">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Nama Lengkap :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="nama lengkap" name="name" value="{{ old('name', $users->name) }}"
                                        id="name" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Jenis Kelamin :</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                            name="gender" id="laki" value="Laki-laki"
                                            {{ $users->gender == 'Laki-laki' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                            name="gender" id="perempuan" value="Perempuan"
                                            {{ $users->gender == 'Perempuan' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Nomor SIM :</label>
                                    <input type="text"
                                        class="form-control @error('driver_license_number') is-invalid @enderror"
                                        placeholder="nomor telepon" name="driver_license_number"
                                        value="{{ old('driver_license_number', $users->driver_license_number) }}"
                                        id="driver_license_number" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Nomor Telepon :</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="nomor telepon" name="phone_number"
                                        value="{{ old('phone_number', $users->phone_number) }}" id="phone_number"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Email :</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="nomor telepon" name="email"
                                        value="{{ old('email', $users->email) }}" id="email" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Alamat :</label>
                                    <textarea type="text" class="form-control @error('address') is-invalid @enderror" placeholder="nomor telepon"
                                        name="address" id="address" readonly>{{ old('address', $users->address) }}</textarea>
                                </div>
                            </div>
                            @auth
                                @if (auth()->user()->id == $users->id)
                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100 disabled" id="tombolPerbarui"
                                            type="submit">Perbarui
                                            Profile</button>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="gantipassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ubah-password', $users->id) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" placeholder="Password"
                                    name="password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user"
                                    placeholder="Repeat Password" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Ganti</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        const editcheck = document.getElementById('editcheck');
        const name = document.getElementById('name');
        const driver_license_number = document.getElementById('driver_license_number');
        const phone_number = document.getElementById('phone_number');
        const email = document.getElementById('email');
        const address = document.getElementById('address');
        const tombolPerbarui = document.getElementById('tombolPerbarui');
        const laki = document.getElementById('laki');
        const perempuan = document.getElementById('perempuan');
        const image = document.getElementById('image');

        editcheck.addEventListener('change', function() {
            name.readOnly = !this.checked;
            driver_license_number.readOnly = !this.checked;
            phone_number.readOnly = !this.checked;
            email.readOnly = !this.checked;
            address.readOnly = !this.checked;
            laki.disabled = !this.checked;
            perempuan.disabled = !this.checked;
            image.disabled = !this.checked;

            if (editcheck.checked) {
                tombolPerbarui.classList.remove('disabled');
            } else {
                tombolPerbarui.classList.add('disabled');
            }
        });
    </script>
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
