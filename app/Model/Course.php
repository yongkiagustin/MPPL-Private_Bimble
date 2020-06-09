<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
