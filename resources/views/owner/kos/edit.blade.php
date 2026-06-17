@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kos</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('owner.kos.update', $kos->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $kos->nama) }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $kos->alamat) }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $kos->harga) }}" required>
        </div>
        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('owner.kos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
