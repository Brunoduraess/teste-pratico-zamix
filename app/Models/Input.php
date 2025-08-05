<?php

namespace App\Models;

use App\Http\Controllers\ProductController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Input extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function produtos(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produto', 'id');
    }

    public function usuarios(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_funcionario', 'id');
    }
}
