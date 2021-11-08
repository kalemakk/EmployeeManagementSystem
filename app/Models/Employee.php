<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'location',
        'email',
        'password',
        'joined',
        'branch',
        'employee_id',
        'status',
        'department_id',
        'position'
    ];

    protected $casts = [
        'joined' => 'date',
    ];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function fullName(){
        return $this->first_name." ".$this->last_name;
    }
    public function branchName(){
        return $this->belongsTo(Branch::class,'branch')->withDefault();
    }

    public static function generatePassword($firstName, $lastName){
        return strtolower($firstName.$lastName);
    }

    public static function employeeNumber(){

    }
}
