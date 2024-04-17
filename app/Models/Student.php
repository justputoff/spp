<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade_id',
        'student_parent_id',
        'ta_student_id',
        'nis',
        'nisn',
        'nik',
        'name',
        'status',
    ];
   
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
   
    public function studentParent(){
        return $this->belongsTo(StudentParent::class);
    }
   
    public function taStudent(){
        return $this->belongsTo(TaStudent::class);
    }
   
    public function sppStudent(){
        return $this->hasOne(SppStudent::class);
    }
}
