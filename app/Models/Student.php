<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','class', 'phone','parent_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
        //return $this->hasMany(ParentModel::class, 'parent_id');
        return $this->belongsTo(\App\Models\ParentModel::class, 'parent_id');

    }
}
