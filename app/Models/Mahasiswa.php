<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';

    protected $fillable = [
        'nim', 'nama', 'angkatan', 'password', 'token'
    ];
    
    protected $hidden = [];

    public function Matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId' ) ?? 'kosong';
    }
}   