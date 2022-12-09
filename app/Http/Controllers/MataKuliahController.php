<?php
namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MataKuliah;

class MataKuliahController extends Controller {

    public function __construct()
    {
        // $this->middleware('jwt_auth');
    }
    
    public function getMataKuliah() 
    {
        $matakuliah = MataKuliah::with('mahasiswa')->get();
        return response()->json([
            'status' => 'Success',
            'message' => 'Show all mata kuliah',
            'matakuliah' => $matakuliah
        ],200);
    }

    public function deleteMataKuliah($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);
        $matakuliah->delete();
    }
}