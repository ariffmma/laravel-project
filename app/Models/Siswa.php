<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Siswa extends Model
{
    use HasFactory;
    use SearchableTrait;
    protected $fillable = [
        'wali_id',
        'wali_status',
        'nama',
        'nisn',
        'jurusan',
        'kelas',
        'angkatan',
        'foto',
    ];
    protected $searchable = [
        'columns' => [
            'wali_status' => 10,
            'nama' => 10,
            'nisn' => 10,
        ],
    ];

    public function wali(){
        return $this->belongsTo(User::class);
    }
}
