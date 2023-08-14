<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'status', 'duration', 'start_date','document','status'];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    protected $casts = [
        'start_date' => 'date'
    ];

    protected static function booted()
    {
        static::updated(function (LeaveRequest $request){
            $request->status = 'submitted';
            $request->reason = '';

        });
    }
    public function  scopeRequestWithOldType($query, $oldType) {
        $query->where('type', $oldType);
    }
}
