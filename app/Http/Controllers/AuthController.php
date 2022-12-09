<?php
namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
class AuthController extends Controller
{
    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    protected function jwt(Mahasiswa $mahasiswa)
    {
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $mahasiswa->nim, 
            'iat' => time(), 
            'exp' => time() + 60 * 60 
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function register(Request $request)
    {
        $nim = $request->nim;
        $nama = $request->nama;
        $angkatan = $request->angkatan;
        $password = Hash::make($request->password);
        $mahasiswa = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'password' => $password,
        ]);
        return response()->json([
            'status' => 'Success',
            'message' => 'New mahasiswa has been added',
            'mahasiswa' => [
                'data' => $mahasiswa
            ]
        ]);
    }

    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if (!$mahasiswa) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Your nim does not exist'
            ]);
        }
        if (!Hash::check($password, $mahasiswa->password)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Your password is wrong'
            ]);
        }

        $mahasiswa->token = $this->jwt($mahasiswa);
        $mahasiswa->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Your login successfuly',
            'token' => $mahasiswa->token
        ]);
    }
}