<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestProduct extends Model
{

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function requisicoes(): BelongsTo
    {
        return $this->belongsTo(Request::class, 'id_requisicao', 'id');
    }

    public function produtos(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produto', 'id');
    }
}
