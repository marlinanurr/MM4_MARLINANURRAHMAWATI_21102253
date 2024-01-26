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
 <div class="container mt-3">
 <div class="row">
 <div class="col-12">
 <div class="pt-3 d-flex justify-content-end align-items-center">
 <h1 class="h2 mr-auto">Biodata {{$student->name}}</h1>
 <a href="{{ route('adminlte.student.edit',['student' => $student->id]) }}"
 class="btn btn-primary">Edit
 </a>
 <form action="{{ route('adminlte.student.destroy',['student'=>$student->id]) }}"
 method="POST">
 @method('DELETE')
 @csrf
<button type="submit" class="btn btn-danger ml-3">Hapus</button>
 </form>
 </div>
 <hr>
 @if(session()->has('pesan'))
 <div class="alert alert-success">
 {{ session()->get('pesan') }}
 </div>
 @endif
 <ul>
 <li>NIM: {{$student->nim}} </li>
 <li>Nama: {{$student->name}} </li>
 <li>Jenis Kelamin:
 {{$student->gender == 'P' ? 'Perempuan' : 'Laki-laki'}}
 </li>
 <li>Jurusan: {{$student->departement}} </li>
 <li>Alamat:
 {{$student->address == '' ? 'N/A' : $student->address}}
 </li>
 </ul>
 </div>
 </div>
 </div>

 </section>
 <!-- /.content -->
 </div>
@endsection