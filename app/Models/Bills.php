<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bills extends Model
{
    use HasFactory;

    public function creator(){
        return $this->belongsTo(User::class, 'uid');
    }

    public function trans(){
        return $this->hasMany(Trans::class,'bill_id');
    }
    protected $fillable = [
        'f_amount',
    ];

}
