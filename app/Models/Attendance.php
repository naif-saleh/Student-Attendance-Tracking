<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'date',
        'status',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
