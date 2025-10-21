@extends('layout')

@section('content')
    {{-- Alert sukses update --}}
    @if (session('successUpdate'))
        <div class="alert alert-success">
            {{ session('successUpdate') }}
        </div>
    @endif

    {{-- Alert sukses delete --}}
    @if (session('successDelete'))
        <div class="alert alert-warning">
            {{ session('successDelete') }}
        </div>
    @endif

    {{-- Alert done --}}
    @if (session('done'))
        <div class="alert alert-success">
            {{ session('done') }}
        </div>
    @endif

    {{-- Alert tambah todo --}}
    @if (Session::get('addTodo'))
        <div class="alert alert-success">
            {{ Session::get('addTodo') }}
        </div>
    @endif

    <div class="container mt-5">
        <table class="table table-success table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Batas Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($todos as $todo)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $todo['title'] }}</td>
                        <td>{{ $todo['description'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($todo['date'])->format('j F, Y') }}</td>
                        <td>{{ $todo['status'] == 1 ? 'Completed' : 'On-Process' }}</td>
                        <td class="d-flex gap-2">
                            {{-- Tombol edit --}}
                            <a href="{{ route('todo.edit', $todo['id']) }}" class="btn btn-primary">Edit</a>

                            {{-- Tombol hapus --}}
                            <form action="{{ route('todo.destroy', $todo['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning">Hapus</button>
                            </form>

                            {{-- Tombol completed (hanya tampil jika status 0) --}}
                            @if ($todo['status'] == 0)
                            <form action="{{ route('todo.update-completed', $todo['id']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success">Completed</button>
                            </form>

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
