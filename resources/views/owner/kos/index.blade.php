@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kos Anda</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('owner.kos.create') }}" class="btn btn-primary">Tambah Kos Baru</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kosList as $kos)
                <tr>
                    <td>{{ $kos->nama }}</td>
                    <td>{{ $kos->alamat }}</td>
                    <td>{{ $kos->harga_format ?? $kos->harga }}</td>
                    <td>
                        <a href="{{ route('owner.kos.edit', $kos->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('owner.kos.destroy', $kos->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kos ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada kos. <a href="{{ route('owner.kos.create') }}">Tambah sekarang</a>.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $kosList->links() ?? '' }}
</div>
@endsection
