<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'quantity',
        'unit_price',
        'entry_date',
        'invoice_number',
        'notes',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'unit_price' => 'decimal:2',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
