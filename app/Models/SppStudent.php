<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'via',
        'bulan',
        'status',
        'price',
        'tahun',
        'student_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
