<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'matakuliahs';

    protected $fillable = [
        'nama'
    ];
    
    protected $hidden = [];

    public function Mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'mkId' ,'mhsNim') ?? 'kosong';
    }
}   