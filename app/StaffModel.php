<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $guarded =['id'];

    public function auth($credential): ?StaffModel
    {

        $user = $this->where('username', $credential['username'])->first();
        if ($user && Hash::check($credential['password'], $user->password)) return $user;
        return null;
    }
}

