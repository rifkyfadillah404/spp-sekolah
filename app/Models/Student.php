<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'class',
        'phone',
        'address',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sppBills()
    {
        return $this->hasMany(SppBill::class);
    }

    public function unpaidBills()
    {
        return $this->hasMany(SppBill::class)->where('status', 'unpaid');
    }
}
