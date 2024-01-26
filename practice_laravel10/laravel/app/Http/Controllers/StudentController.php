<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use File;

class StudentController extends Controller
{
    public function create()
    {
        return view('student.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8,unique:student',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'required|file|image|max:1000',
        ]);
        $mahasiswa = new Student();
        $mahasiswa->nim = $validateData['nim'];
        $mahasiswa->name = $validateData['nama'];
        $mahasiswa->gender = $validateData['jenis_kelamin'];
        $mahasiswa->departement = $validateData['jurusan'];
        $mahasiswa->address = $validateData['alamat'];
        if($request->hasFile('image'))
        {
            $extFile = $request->image->getClientOriginalExtension();
            $namaFile = 'user-'.time().".".$extFile;
            $path = $request->image->move('assets/images',$namaFile);
            $mahasiswa->image = $path;
        }
        $mahasiswa->save();
        $request->session()->flash('pesan','Penambahan data berhasil');
        return redirect()->route('student.index');
    }
    public function index()
    {
        $mahasiswas = Student::all();
        return view('student.index',['student' => $mahasiswas]);
    }
    public function show($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('student.show',['student' => $result]);
    }
    public function edit($student_id)
    {
    $result = Student::findOrFail($student_id);
    return view('student.edit',['student' => $result]);
    }

    public function update(Request $request, Student $student)
    {
        $validateData = $request->validate([
        'nim' => 'required|size:8,unique:student',
        'nama' => 'required|min:3|max:50',
        'jenis_kelamin' => 'required|in:P,L',
        'jurusan' => 'required',
        'alamat' => '',
        'image' => 'file|image|max:1000',
        ]);
        $student->nim = $validateData['nim'];
        $student->name = $validateData['nama'];
        $student->gender = $validateData['jenis_kelamin'];
        $student->departement = $validateData['jurusan'];
        $student->address = $validateData['alamat'];
        if($request->hasFile('image'))
        {
            $extFile = $request->image->getClientOriginalExtension();
            $namaFile = 'user-'.time().".".$extFile;
            File::delete($student->image);
            $path = $request->image->move('assets/images',$namaFile);
            $student->image = $path;
        }
        $student->save();
        $request->session()->flash('pesan','Perubahan data berhasil');
        return redirect()->route('student.show',['student' => $student->id]);
    }
    public function destroy(Request $request, Student $student)
    {
        File::delete($student->image);
        $student->delete();
        $request->session()->flash('pesan','Hapus data berhasil');
        return redirect()->route('student.index');
    }
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('username');
        $table->string('password');
        $table->timestamps();
        });
    }


    
}
