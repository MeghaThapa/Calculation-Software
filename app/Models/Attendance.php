<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillables=[
            'name',
            'staff_id',
            'date',
            'status',
            'ot_hours'
    ];
}
