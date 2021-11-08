<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'status',
        'employee_id',
        'created_by_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }


}
