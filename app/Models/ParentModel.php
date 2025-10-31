<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentModel extends Model
{
     use HasFactory;
    protected $table = 'parents';

    protected $fillable = ['name','email','phone','student_id'];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    // (optional) Relationship to Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
