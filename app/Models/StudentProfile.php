<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'roll_number',
        'branch',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
