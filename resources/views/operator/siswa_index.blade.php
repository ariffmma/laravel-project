@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body">
                <a href="{{ route($routePrefix.'.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                {!! Form::open(['route' => $routePrefix. '.index','method' => 'GET']) !!}
                <div class="input-group mt-3">
                    <input name="input_search" type="text" class="form-control" placeholder="Cari nama" aria-label="Cari nama" aria-describedby="button-addon2" value="{{ request('input_search') }}">
                    <button type="submit" class="btn btn-outline-primary" id="button-addon2"><i class="bx bx-search"></i></button>
                </div>
                {!! Form::close() !!}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Wali Murid</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->wali->name  ?? 'Belum ada wali murid' }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td>{{ $item->jurusan }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->angkatan }}</td>
                                    <td>
                                        
                                        {!! Form::open([
                                            'route' => [$routePrefix.'.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin ingin menghapus data ini?")',
                                        ]) !!}
                                        <a href="{{ route($routePrefix.'.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Data tidak ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $models->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
