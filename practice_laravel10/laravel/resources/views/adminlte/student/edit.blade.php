@extends('admin_layout.app')

@section('header')
    @include('admin_layout.header')
@endsection

@section('leftbar')
    @include('admin_layout.leftbar')
@endsection

@section('rightbar')
    @include('admin_layout.rightbar')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Pendaftaran Mahasiswa</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container pt-4 bg-white">
                <div class="row">
                    <div class="col-md-8 col-xl-6">
                        <h1>Edit Mahasiswa</h1>
                        <hr>
                        <form action="{{ route('adminlte.student.update',['student' => $student->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                                    name="nim" value="{{ old('nim') ?? $student->nim }}">
                                @error('nim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('name') ?? $student->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                            value="L" {{ (old('gender') ?? $student->gender) == 'L' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="perempuan" value="P"
                                            {{ (old('gender') ?? $student->gender) == 'P' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" name="jurusan" id="jurusan">
                                    <option value="Teknik Informatika"
                                        {{ (old('departement') ?? $student->departement) ==
                                            'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika
                                    </option>
                                    <!-- Add other options here -->
                                </select>
                                @error('departement')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3"
                                    name="alamat">{{ old('alamat') ?? $student->address }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mb-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
