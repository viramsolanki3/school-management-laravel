<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id','author_role','title','body',
        'to_teachers','to_students','to_parents'
    ];

    public function author()
    {
        //return $this->belongsTo(User::class, 'author_id');
         return $this->belongsTo(\App\Models\User::class, 'author_id');
    }
}
