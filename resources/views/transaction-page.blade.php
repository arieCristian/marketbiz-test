<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interview Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    @livewireStyles
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">CURD Sederhana</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/transaction">Transaction Page</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center">
        <div class="my-container mt-4 mb-4">
            <h1>Transaction Page</h1>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="/transaction" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pembeli</label>
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name"/>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input value="{{ old('phone') }}" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                    id="phone"/>
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" value="{{ old('email') }}"/>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <table class="table">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th style="width: 20%">Qty</th>
                        </tr>
                        <tr>
                            <td>Baju Kaos Polos</td>
                            <input type="hidden" name="product[]" value="baju kaos polos">
                            <td>70000</td>
                            <input type="hidden" name="price[]" value="70000">
                            <td><input name="qty[]" class="form-control" type="number" value="0" min="0"></td>
                        </tr>
                        <tr>
                            <td>Kemeja Lengan Panjang</td>
                            <input type="hidden" name="product[]" value="kemeja lengan panjang">
                            <td>100000</td>
                            <input type="hidden" name="price[]" value="100000">
                            <td><input name="qty[]" class="form-control" type="number" value="0" min="0"></td>
                        </tr>
                        <tr>
                            <td>Celana Jeans</td>
                            <input type="hidden" name="product[]" value="celana jeans">
                            <td>150000</td>
                            <input type="hidden" name="price[]" value="100000">
                            <td><input name="qty[]" class="form-control" type="number" value="0" min="0"></td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">Buat Pesanan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    @livewireScripts
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
</body>

</html>
