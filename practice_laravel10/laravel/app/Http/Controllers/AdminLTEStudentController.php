<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminLTEStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Student::all();
        return view('adminlte.student.index',['students' => $mahasiswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminlte.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8,unique:students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            ]);
            $mahasiswa = new Student();
            $mahasiswa->nim = $validateData['nim'];
            $mahasiswa->name = $validateData['nama'];
            $mahasiswa->gender = $validateData['jenis_kelamin'];
            $mahasiswa->departement = $validateData['jurusan'];
            $mahasiswa->address = $validateData['alamat'];
            $mahasiswa->save();
            $request->session()->flash('pesan','Penambahan data berhasil');
            return redirect()->route('adminlte.student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('adminlte.student.show',['student' => $result]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('adminlte.student.edit',['student' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8,unique:students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            ]);
            $student->nim = $validateData['nim'];
            $student->name = $validateData['nama'];
            $student->gender = $validateData['jenis_kelamin'];
            $student->departement = $validateData['jurusan'];
            $student->address = $validateData['alamat'];
            $student->save();
            $request->session()->flash('pesan','Perubahan data berhasil');
            return redirect()->route('adminlte.student.show',['student' => $student->id]);
           
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Student $student)
    {
        $student->delete();
        $request->session()->flash('pesan','Hapus data berhasil');
        return redirect()->route('adminlte.student.index');
    }

}
