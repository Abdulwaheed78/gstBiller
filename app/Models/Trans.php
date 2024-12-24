<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
    use HasFactory;
    protected $table = 'bill_trans';
    public function bill()
    {
        return $this->belongsTo(Bills::class, 'bill_id');
    }

    protected $fillable = [
        'bill_id',
        'description',
        'qty',
        'actual_amount',
        'gst_rate',
        'gst_amount',
        'final_amount',
        'puc',
    ];
}
