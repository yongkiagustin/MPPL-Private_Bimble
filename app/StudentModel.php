<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $guarded =['id'];

    public function auth($credential): ?StudentModel
    {

        $user = $this->where('username', $credential['username'])->first();
        if ($user && Hash::check($credential['password'], $user->password)) return $user;
        return null;
    }
}
