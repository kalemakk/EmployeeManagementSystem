<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidSalary extends Model
{
    use HasFactory;

    protected $fillable =  [
        'salary_id',
        'desc',
        'approved_by'
    ];

    public function salary(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Salary::class,'salary_id');
    }

    public function approvedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'approved_by');
    }
}
