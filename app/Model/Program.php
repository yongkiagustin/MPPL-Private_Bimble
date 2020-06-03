<?php

namespace App\Model;

use App\StudentModel;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function students()
    {
        return $this->hasMany(StudentModel::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
