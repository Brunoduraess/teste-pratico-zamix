<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function produtos(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produto', 'id');
    }
}
