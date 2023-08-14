<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    protected static function booted()
    {
        static::updated(function (LeaveType $request){
            // $request->
        });
    }
}
