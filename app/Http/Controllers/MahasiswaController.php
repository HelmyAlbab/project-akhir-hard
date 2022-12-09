<?php
namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller {

    public function __construct()
    {
        
    }

    public function getAllMahasiswa()
    {
        $mahasiswa = Mahasiswa::with('matakuliah')->get();
        return response()->json([
            'status' => 'Success',
            'message' => 'Show all mahasiswa',
            'mahasiswa' => $mahasiswa
        ],200);
    }

    public function getAllMahasiswaByToken(Request $request)
    {
        $mahasiswa = $request->mahasiswa;
        return response()->json([
            'status' => 'Success',
            'message' => 'Hallo ' . $mahasiswa->nama,
            'mahasiswa' => $mahasiswa
        ],200);
    }

    public function getMahasiswaById(Request $request) 
    {
        $nim = $request->nim;
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'mahasiswa' => $mahasiswa,
                'matakuliah' => $mahasiswa->matakuliah
            ]);
        }

        return response()->json([
            'mahasiswa' => $mahasiswa,
            'matakuliah' => $mahasiswa->matakuliah
        ]);
    }

    public function addMataKuliahtoMhs(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);
        $mahasiswa->matakuliah()->attach($request->id);
        return response()->json([
            'status' => 'Success',
            'message' => 'Mata kuliah has been added for mahasiswa ' . $mahasiswa->nama
        ],200);
    }

    public function deleteMataKuliah(Request $request){
        $mahasiswa = Mahasiswa::find($request->nim);
        $mahasiswa->matakuliah()->detach($request->id);
        return response()->json([
            'status' => 'Success',
            'message' => 'Mata kuliah has been deleted for mahasiswa '. $mahasiswa->nama 
        ]);
    }

    public function deleteMahasiswa($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        if ($mahasiswa === null) {
            return response()->json([
                'message' => 'Nim not found'
            ]);
        }
        $mahasiswa->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Mahasiswa '. $mahasiswa->nama .' has been deleted'
        ]);
    }
}