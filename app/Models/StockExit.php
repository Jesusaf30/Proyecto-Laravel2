<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockExit extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'quantity',
        'unit_price',
        'exit_date',
        'reason',
        'notes',
    ];

    protected $casts = [
        'exit_date' => 'date',
        'unit_price' => 'decimal:2',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
