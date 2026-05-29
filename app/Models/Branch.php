<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'code',
        'name',
        'city',
        'status'
    ];

    // 🔥 INI YANG KAMU LUPA
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}