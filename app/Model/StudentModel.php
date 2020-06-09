<?php

namespace App\Model;

use App\Model\Classroom;
use App\Model\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at', 'password'];

    public function auth($credential): ?StudentModel
    {
        $user = $this->where('username', $credential['username'])->first();
        if ($user && Hash::check($credential['password'], $user->password)) return $user;
        return null;
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
